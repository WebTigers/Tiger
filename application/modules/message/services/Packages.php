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
 * Class Message Service Packages
 *
 * Calling this class without any params once each day will check the package table for any package updates and then
 * publish a notification that there are package updates ready to be installed.
 *
 * http://localhost/api/service/message:packages/method/checkForPackageUpdates
 *
 */
class Message_Service_Packages extends Core_Service_Webservice
{
    protected $_messageService;
    protected $_packageModel;

    public function __construct ( $params )
    {
        $this->_messageService  = new Message_Service_Admin([]);
        $this->_packageModel    = new Package_Model_Package();

        parent::__construct( $params );

    }

    public function checkForPackageUpdates ( $params ) {

        if ( $this->_hasPackageUpdates() ) {

            $this->_sendNotification();

            Tiger_Log::db(
                'Message_Service_Packages',
                'Package check ran successfully. New updates found.',
            );

        }
        else {

            Tiger_Log::db(
                'Message_Service_Packages',
                'Package check ran successfully. No new updates.'
            );

        }

    }

    protected function _hasPackageUpdates ( )
    {
        $packageRowset = $this->_packageModel->getAdminPackageSearchList();
        $updates = false;
        foreach ( $packageRowset as $packageRow ) {
            if ( $packageRow->version !== $packageRow->latest ) {
                $updates = true;
            }
        }
        return $updates;
    }

    protected function _sendNotification ( )
    {
        $start_date = new DateTime();
        $end_date   = new DateTime();
        $end_date->add( new DateInterval('P1Y') );

        $message = [
            'title'         => 'SYSTEM.MESSAGE.TITLE.NEW_PACKAGE_UPDATES',
            'message'       => 'SYSTEM.MESSAGE.TEXT.NEW_PACKAGE_UPDATES',
            'format'        => 'alert',
            'dismissible'   => 1,
            'link'          => '/admin/package',
            'target'        => 'message:notification',
            'start_date'    => $start_date->format('Y-m-d H:i:s'),
            'end_date'      => $end_date->format('Y-m-d H:i:s')
        ];

        $this->_messageService->publish( $message );
        echo json_encode( $this->_messageService->getResponse()->toArray() );

    }

}