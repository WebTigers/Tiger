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

class Account_AdminController extends Tiger_Controller_Admin
{

    public function init()
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('ACCOUNTS');

        /** Global Footer */
        $this->view->template->name = Zend_Registry::get('Zend_Config')->tiger->platform->name;
        $this->view->template->version = Zend_Registry::get('Zend_Config')->tiger->platform->version;

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard', 'admin', 'core');
    }

    public function orgAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.org.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.user.address.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.user.contact.js' ) );
        $this->view->orgForm = new Account_Form_Org();
        $this->view->addressForm = new Account_Form_Address();
        $this->view->contactForm = new Account_Form_Contact();
    }

    public function userAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.user.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.user.address.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.user.contact.js' ) );
        $this->view->userForm = new Account_Form_User();
        $this->view->addressForm = new Account_Form_Address();
        $this->view->contactForm = new Account_Form_Contact();
    }

    public function addressAction ( )
    {
        //$this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.address.js' ) );
        //$this->view->addressForm = new Account_Form_Address();
    }

    public function contactAction ( )
    {
        //$this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/admin.contact.js' ) );
        //$this->view->contactForm = new Account_Form_Contact();
    }

}

