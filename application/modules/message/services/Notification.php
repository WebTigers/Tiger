<?php

class Message_Service_Notification extends Core_Service_Webservice
{
    protected $_auth;
    protected $_translate;
    protected $_utility;

    protected $_messageModel;
    protected $_notificationModel;
    protected $_templateService;
    protected $_messageService;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_utility     = new Core_Service_Utility;
        $this->_form        = new Message_Form_Message;

        $this->_messageModel        = new Message_Model_Message;
        $this->_notificationModel   = new Message_Model_Notification;
        $this->_templateService     = new Message_Service_Template;
        $this->_messageService      = new Message_Service_Admin([]);

        parent::__construct( $input );

    }

    ##### Publish Functions #####

    public function publish( $message )
    {
        /**
         * A publish function is designed to do make a message-capable module "aware" of messages that pertain to itself.
         * Often a message-capable module can just read the message table directly and look for messages it is concerned
         * about. In the case of notifications, we need to assign the message to specific users and these users need to
         * be able to interact with the message via a linking table.
         *
         * When the message is saved, it will pass the message here for persistence to one or more users.
         * 1) Get a list of users the message will publish to.
         * 2) Remove (soft-delete) those user links from the DB table that are not within the user collection any longer
         *    (if an update).
         * 3) If the user link does not already exist, add the link to the DB table.
         *
         * For very large user datasets, you may want to subclass this service and override this method to paginate the
         * publish process or move it to a queue for processing. Simply target your messages to the new module:service
         * class for publishing.
         *
         * Note that only the saveMessage method invokes the publish() call. The updateMessage() method does not since
         * it is really only concerned with setting the active and deleted flags of the record.
         */

        try {

            $this->_form = new Message_Form_Message();

            /**
             * Note that in Tiger, isValid() is subclassed to remove any request routing
             * params that are not part of the form. If you wish to preserve the entire
             * $params array, call the $form->isValidPreserve() method instead.
             *
             * Note: To pass validation, the fields "send_user", "send_roles", and "send_orgs"
             * need to be in the form of a JSON string. Otherwise validation will fail.
             */
            if ( ! $this->_form->isValid( $message ) ) {

                /**
                 * We use a convenience method to set the form errors into
                 * the responseObject and we're done here.
                 */
                $this->_setFormErrors();
                return;

            }

            /** Gets the filtered and validated values from the form. We've got clean data. */
            $data = $this->_form->getValues();

            $userIds    = ( ! empty( $data['send_users'] ) ) ? json_decode( $data['send_users'] ) : '';
            $roleIds    = ( ! empty( $data['send_roles'] ) ) ? json_decode( $data['send_roles'] ) : '';
            $orgIds     = ( ! empty( $data['send_orgs']  ) ) ? json_decode( $data['send_orgs']  ) : '';

            /** Create an array list of users should be receiving this notification. */
            $targetUserRowset = $this->_notificationModel->getUsersByMessageParams( $userIds, $roleIds, $orgIds );
            $targetUserIds = [];
            foreach ( $targetUserRowset as $targetUserRow ) {
                $targetUserIds[] = $targetUserRow->user_id;
            }

            /** Create an array list of users are already receiving this notification. More often than not, this is empty. */
            $existUserRowset = $this->_notificationModel->getNotificationsByMessageId( $data['message_id'] );
            $existUserIds = [];
            foreach ( $existUserRowset as $existUserRow ) {
                $existUserIds[] = $existUserRow->user_id;
            }

            /** Get an array list of those users who are no longer set to receive the alert, ad soft-delete the record. */
            $removeUserIds = array_diff( $existUserIds, $targetUserIds );
            $this->_deleteUsersFromNotification( $removeUserIds, $data['message_id'] );

            /** Now persist each of the user notifications. */
            $addUserIds = array_diff( $targetUserIds, $existUserIds );
            foreach ( $addUserIds as $userId ) {

                $this->_messageService->saveNotification([
                    'user_id'       => $userId,
                    'message_id'    => $data['message_id'],
                    'active'        => 1,
                    'deleted'       => 0
                ]);

            }

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->setTextMessage( 'MESSAGE.NOTIFICATION_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NOTIFICATION_SAVE_FAILED', 'error' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    protected function _deleteUsersFromNotification( $userIds, $messageId )
    {
        foreach( $userIds as $userId ) {
            $notificationRow = $this->_notificationModel->getNotificationByUserIdMessageId( $userId, $messageId );
            if ( ! empty( $notificationRow ) ) {
                $notificationRow->deleted = 1;
                $notificationRow->saveRow();
            }
        }
    }

    ##### Notification Utility Methods #####

    public function getUserNotifications ( )
    {
        $notificationResponse   = $this->getNotifications( $this->_auth->getIdentity()->user_id );
        $notifications          = $this->buildNotifications( $notificationResponse->data );

        $count      = $notificationResponse->count;
        $ringing    = ( $notificationResponse->count > 0 ) ? 'ringing' : '';

        $content =
            '<div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="si si-bell ' . $ringing . '"></i>';
        if ( $notificationResponse->count > 0 ) {
            $content .= '<span class="badge badge-primary badge-pill">' . $count . '</span>';
        }
        $content .=
            '</button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-primary text-center">
                        <h5 class="dropdown-header text-uppercase text-white">' . $this->_translate->_('NOTIFICATIONS') . '</h5>
                    </div>
                    <ul class="nav-items mb-0">';
        $content .= $notifications;
        $content .=
            '</ul>';

        if ( $notificationResponse->hasMore ) {
            $content .=
                '<div class="p-2 border-top">
                       <a id="notification-load-more" class="btn btn-sm btn-light btn-block text-center" href="#">
                           <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More ...
                       </a>
                   </div>
                </div>';
        }

        $content .=
            '</div>';

        return $content;

    }

    protected function getNotifications ( $user_id )
    {
        $notificationResponse = (object) [
            'data'  => $this->_notificationModel->getNotificationListByUserId( $user_id, '', 0, 0, 'start_date DESC' ),
            'count' => $this->_notificationModel->getNotificationListByUserId( $user_id )->count(),
            'hasMore' => false,
        ];
        return $notificationResponse;
    }

    protected function buildNotifications ( $notificationRowset )
    {
        $notificationsHTML = '';
        if ( $notificationRowset->count() > 0 ) {
            foreach ( $notificationRowset as $notificationRow ) {
                $data = $notificationRow->toArray();
                $data['wrapper'] = false;
                $notificationsHTML .= $this->_templateService->notification( $data );
            }
        }
        else {
            $message = [
                'message_id'    => '',
                'title'         => '',
                'message'       => 'NOTIFICATION.NO_NOTIFICATIONS',
                'format'        => 'text',
                'icon_class'    => '',
                'start_date'    => '',
                'link'          => '',
                'link_new'      => '',
                'dismissible'   => false,
                'wrapper'       => false,
            ];
            $notificationsHTML .= $this->_templateService->notification( $message );
        }
        return $notificationsHTML;
    }

    public function dismiss ( $params ) {

        $user_id = $this->_auth->getIdentity()->user_id;

        try {

            if ( Tiger_Utility_Uuid::is_valid( $params['message_id'] ) ) {

                $notificationRow = $this->_notificationModel->getNotificationByUserIdMessageId( $user_id, $params['message_id'] );

                if ( ! empty( $notificationRow ) ) {

                    $notificationRow->active = 0;
                    $notificationRow->saveRow();

                    $this->_response->result = 1;
                    $this->_response->data = (object) $notificationRow->toArray();
                    $this->_response->setTextMessage( 'MESSAGE.NOTIFICATION_UPDATED', 'error' );

                }

            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage( 'MESSAGE.NOTIFICATION_NOT_UPDATED', 'error' );

            }

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NOTIFICATION_NOT_UPDATED', 'error' );

            Tiger_Log::error( 'Message_Service_Notification->dismiss(): ' . $e->getMessage() );

        }

    }

}
