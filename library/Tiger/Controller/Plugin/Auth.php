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

class Tiger_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    const GUEST = "guest";

    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
        /**
         * If we're not logged in and don't have an authenticated
         * identity, then create a "guest" identity.
         */
        $auth = Zend_Auth::getInstance();

        if ( ! $auth->hasIdentity() ) {

            $identity = (object)[
                'user_id' => GUEST_USER_ID,
                'username' => self::GUEST,
                'org_id' => null,
                'orgname' => null,
                'role' => self::GUEST,
            ];

            $auth->getStorage()->write($identity);
            self::setSessionDbIdentity( $identity );

        }
        else {

            self::setSessionDbIdentity( $auth->getIdentity() );

        }

    }

    /**
     * This utility function allows us to set some identity fields in the
     * session table that allow us to query who is currently online, or
     * at least who has an active session.
     *
     * @param null $identity
     */
    public static function setSessionDbIdentity ( $identity = null )
    {
        $sessionModel = new Core_Model_Session();
        $sessionRow = $sessionModel->getSessionById( Zend_Session::getId() );

        if ( ! empty($sessionRow) && ! empty($identity) ) {

            $sessionRow->user_id    = $identity->user_id;
            $sessionRow->username   = $identity->username;
            $sessionRow->org_id     = $identity->org_id;
            $sessionRow->orgname    = $identity->orgname;

            $sessionRow->save();

        }

    }

}