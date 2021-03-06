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

class ManageController extends Tiger_Controller_Manage
{
    public function init()
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global Footer */
        $this->view->template->name = Zend_Registry::get('Zend_Config')->tiger->platform->name;
        $this->view->template->version = Zend_Registry::get('Zend_Config')->tiger->platform->version;

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard');
    }

    public function dashboardAction ( )
    {
        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate( 'MANAGE.DASHBOARD' );
        $this->_checkPassword();
    }

    public function adminAction ( )
    {
        $port = ( $_SERVER['REQUEST_SCHEME'] === 'http' ) ? '8080' : '8081' ;
        $uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $port . '/admin';
        $this->redirect( $uri );
    }

    private function _checkPassword ( )
    {
        if ( ! empty( Zend_Auth::getInstance()->getIdentity()->password_reset_key )  ) {
            $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerPassword.js' ) );
            $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.reset.password.js' ) );
            $this->view->passwordForm = new Account_Form_Password();
        }

    }

}

