<?php
/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

/**
 * Class NotificationTrait
 */
trait Message_Service_NotificationTrait
{
    ##### Admin Service Functions #####

    /**
     * Perhaps one of the more complicated API calls is for DataTables. DataTables posts
     * a boatload of varied params based on the data within table. These DataTables functions
     * consume that set of params and notificationanize it into something our models can deal with.
     *
     * This DataTable function is a pattern repeated over and over within Tiger and is easily
     * copy and paste for your unique DataTables use cases within the Tiger platform.
     *
     * @param $post
     * @return object DataTables response
     */
    public function getAdminNotificationsDataTable ( $post ) {

        $validationResponse = $this->_utility->validateDataTables( $post );

        if ( $validationResponse === true ) {

            /** Are we ordering by some column(s)? */
            $orderby = '';
            if ( count($post['order']) > 0 ) {
                foreach ( $post['order'] as $order) {
                    $columnNumber = $order['column'];
                    $direction = $order['dir'];
                    $orderby .= $post['columns'][$columnNumber]['name'] . " " . $direction . ", ";
                }
                $orderby = substr($orderby, 0, -2);
            }

            /** DataTables needs a filtered count for pagination */
            $recordsTotalRowset = $this->getAdminNotificationSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminNotificationSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->notification_id;
                $record->controls = $this->_getNotificationActions( $record );
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.TITLE',
                'DT.MESSAGE',
                'DT.TARGET',
                'DT.TYPE_STATUS',
                'DT.ROUTE',
                'DT.LOCALE',
                'DT.START_DATE',
                'DT.END_DATE',
                'DT.ACTIONS',
                'DT.MESSAGE_ID',
                'DT.ACTIVE',
                'DT.DELETED',
            ]);

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
                'i18n'              => $headers,
            ]);

        }
        else {

            /** Set an empty the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => 0,
                'recordsFiltered'   => 0,
                'data'              => [],
                'error'             => $validationResponse
            ]);

        }

    }

    /**
     * getAdminNotificationSearchList returns a rowset of notifications.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminNotificationSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {
        return $this->_notificationModel->getAdminNotificationSearchList( $search, $offset, $limit, $orderby );
    }

    /**
     * @param $notification
     * @return array
     */
    protected function _getNotificationActions ( $notification )
    {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $notification->notification_id,                      // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_MESSAGE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $notification->notification_id,
            'value'     => $notification->active,
            'class'     => ( intval($notification->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_MESSAGE'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $notification->notification_id,
            'value'     => $notification->deleted,
            'class'     => ( intval($notification->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_MESSAGE'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

    }

    /**
     * @param $params
     * @return null, Sets response object.
     */
    public function getNotificationTemplate ( $params )
    {
        if ( $this->_form->isValidPartial( $params ) ) {

            $data = $this->_form->getValidValues( $params );

            try {

                $module = explode(':', $data['target'] ) [0];
                $method = explode(':', $data['target'] ) [1];

                $class = ucfirst( strtolower( $module ) ) . '_Service_Template';
                $templateService = new $class();

                if ( method_exists( $templateService, $method ) ) {

                    $template = $templateService->$method( $data );

                    $this->_response->result = 1;
                    $this->_response->data = $template;

                }
                else {

                    throw new Exception('Template does not exist.');

                }

            }
            catch ( Error | Exception $e ) {

                pr( $e->getNotification() );

                Tiger_Log::error( $e->getNotification() );

            }

        }
        else {

            $this->_setFormErrors();

        }

    }

    /**
     * @param $params
     * @return null, Sets the response model.
     */
    public function getNotification ( $params )
    {
        if ( ! empty( $params['notification_id'] ) && Tiger_Utility_Uuid::is_valid( $params['notification_id'] ) ) {

            $notificationRow = $this->_notificationModel->getNotificationById( $params['notification_id'] );

            $this->_response->result = 1;
            $this->_response->data = $notificationRow->toArray();

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextNotification( 'MESSAGE.MESSAGE_NOT_FOUND', 'alert' );

        }

    }

    public function getUserCount ( $params )
    {
        $userIds    = ( ! empty( $params['send_users'] ) ) ? $params['send_users'] : '';
        $roleIds    = ( ! empty( $params['send_roles'] ) ) ? $params['send_roles'] : '';
        $orgIds     = ( ! empty( $params['send_orgs'] ) )  ? $params['send_orgs']  : '';

        $count = $this->_notificationModel->getUserCount( $userIds, $roleIds, $orgIds )->total;
        $message = sprintf( $this->_translate->translate('MESSAGE.TOTAL_USERS'), number_format( $count ) );

        $this->_response->status = 1;
        $this->_response->data = $count;
        $this->_response->setTextMessage( $message, 'info' );
    }

    ##### Notification Persistence Methods #####

    /**
     * Service "update" methods essentially are the gateway to persisting small
     * pieces of form data. Update is responsible for validating and then forwarding
     * the tiny bits of clean data to the "persist" method for any grooming which
     * is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function updateNotification ( $params )
    {

        $this->_form = new Message_Form_Notification();

        /**
         * Note that in Tiger, isValid() is subclassed to remove any request routing
         * params that are not part of the form. If you wish to preserve the entire
         * $params array, call the $form->isValidPreserve() method instead.
         */
        if ( ! $this->_form->isValidPartial( $params ) ) {

            /**
             * We use a convenience method to set the form errors into
             * the responseObject and we're done here.
             */
            $this->_setFormErrors();
            return;

        }

        /** Gets the filtered and validated values from the form. We've got clean data. */
        $data = $this->_form->getValidValues( $params );

        try {

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the notification being persisted
             * we don't need the $notificationRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $notificationRow = $this->_persistNotification( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $notification = (object) $notificationRow->toArray();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $notification;
            $this->_response->setTextNotification( 'MESSAGE.MESSAGE_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextNotification( 'MESSAGE.UPDATE_FAILED', 'alert' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getNotification() );

        }

    }

    /**
     * Service "save" methods essentially are the gateway to persisting whole forms
     * of data. Save is responsible for validating and then forwarding clean data to
     * the "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function saveNotification ( $params )
    {

        try {

            $this->_form = new Message_Form_Notification();

            /**
             * Note that in Tiger, isValid() is subclassed to remove any request routing
             * params that are not part of the form. If you wish to preserve the entire
             * $params array, call the $form->isValidPreserve() method instead.
             */
            if ( ! $this->_form->isValid( $params ) ) {

                /**
                 * We use a convenience method to set the form errors into
                 * the responseObject and we're done here.
                 */
                $this->_setFormErrors();
                return;

            }

            /** Gets the filtered and validated values from the form. We've got clean data. */
            $data = $this->_form->getValues();

            /**
             * Since we're not really doing anything with the notification being persisted
             * we don't need the $notificationRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $notificationRow = $this->_persistNotification( $data );

            $notification = (object) $notificationRow->toArray();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $notification;
            $this->_response->setTextMessage( 'MESSAGE.MESSAGE_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'error' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getNotification() );

        }

    }

    /**
     * PersistNotification is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the notification table. If you
     * pass in a populated notification_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @return mixed
     * @throws Exception
     */
    protected function _persistNotification( $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a notification_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['notification_id'] ) ) {

            $notificationRow = $this->_notificationModel->getNotificationById( $data['notification_id'] );

            if ( empty($notificationRow) ) {
                throw new Exception('ERROR.NOTIFICATION_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $notificationRow->setFromArray( $data );

            }
            else {

                unset( $data['notification_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $notificationRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $notificationRow = $this->_notificationModel->createRow( $data );

            /**
             * Update the relevant pieces with new notification system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $notificationRow->notification_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new notification to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this notification. In our use case
         * we simply return the entire row object.
         */
        $notificationRow->saveRow();
        return $notificationRow;

    }

}