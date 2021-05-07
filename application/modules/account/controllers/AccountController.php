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

class Account_AccountController extends Tiger_Controller_Manage
{

    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('ACCOUNTS');

        $this->view->template->inc_side_overlay = '';
        $this->view->template->inc_sidebar      = '';
        $this->view->template->inc_header       = '';
        $this->view->template->inc_footer       = '';

        $this->view->template->name = Zend_Registry::get('Zend_Config')->tiger->platform->name;
        $this->view->template->version = Zend_Registry::get('Zend_Config')->tiger->platform->version;

    }

    ### Public Actions ###

    public function indexAction ( )
    {
        $this->forward('dashboard', 'manage', 'core');

    }

    public function signupAction ( )
    {

        /** Add the tigerPassword widget. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerPassword.js' ) );

        /** Add the signup page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.signup.js' ) );

        $this->view->signupForm = new Account_Form_Signup();

    }

    public function welcomeAction ( )
    {
        /** Add the welcome page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.welcome.js' ) );

        $this->view->user = Zend_Auth::getInstance()->getIdentity();

        $resendForm = new Account_Form_Resend();
        $resendForm->getElement('user_id')->setValue( $this->view->user->user_id );
        $this->view->resendForm = $resendForm;

    }

    public function loginAction ( )
    {
        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.login.js' ) );

        $this->view->loginForm = new Account_Form_Login();

        if ( isset( $_COOKIE['username'] ) ) {
            $this->view->loginForm->getElement('username')->setValue( $_COOKIE['username'] );
            $this->view->loginForm->getElement('remember_me')->setChecked( true );
        }

    }

    public function lockAction ( )
    {
        $username =  Zend_Auth::getInstance()->getIdentity()->username;

        Zend_Auth::getInstance()->clearIdentity();  // <-- This logs us out of the application.
        Zend_Session::regenerateId();               // <-- Gets us a shiny new session id.

        $this->view->loginForm = new Account_Form_Login();
        $this->view->loginForm->getElement('username')->setValue( $username );

        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.login.js' ) );

    }

    public function logoutAction ( )
    {
        Zend_Auth::getInstance()->clearIdentity();  // <-- This logs us out of the application.
        Zend_Session::regenerateId();               // <-- Gets us a shiny new session id.

        /**
         * We could set a guest identity here, but at this point we're on the public logout page and a
         * new guest identity will be generated automagically on the next public page hit. No worries.
         */

        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.login.js' ) );

        $this->view->loginForm = new Account_Form_Login();

        if ( isset( $_COOKIE['username'] ) ) {
            $this->view->loginForm->getElement('username')->setValue( $_COOKIE['username'] );
            $this->view->loginForm->getElement('remember_me')->setChecked( true );
        }

    }

    public function verifyAction ( )
    {

         $request = $this->getRequest();
         $request->setParam('method', 'verify');

         /**
          * Notice how we can just pass in the request object to have to Account Service
          * auto-route to the verify method, do the work, and then we can just poll the
          * service for the response once the service in instantiated.
          */
         $accountService = new Account_Service_Account( $request );
         $this->view->response = $accountService->getResponse();

    }

    public function recoverAction ( )
    {
        $this->view->loginForm = new Account_Form_Login();
        $this->view->loginForm->getElement('username')->setAttrib('placeholder', $this->view->translate('RECOVER.USERNAME_EMAIL'));

        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.recover.js' ) );

    }

    public function passwordAction ( )
    {

        $request = $this->getRequest();
        $request->setParam('method', 'login');

        /**
         * Notice how we can just pass in the request object to have to Account Service auto-route to the login method,
         * auto-login, and then we can just poll the service for the response once the service in instantiated.
         */
        $accountService = new Account_Service_Account( $request );
        $this->view->response = $accountService->getResponse();

        /** If we have a valid login, just redirect the user to their profile password reset page. */

        $role = Zend_Auth::getInstance()->getIdentity()->role;
        if ( Zend_Registry::get('Zend_Acl')->isAllowed( $role, 'Core_Controller_Manage', 'dashboard' ) ) {
            $this->forward('dashboard', 'manage', 'core');
        }
        else {
            $this->forward('recover');
        }

    }

    public function profileAction ( )
    {
        $this->view->userForm       = new Account_Form_User();
        $this->view->orgForm        = new Account_Form_Org();
        $this->view->addressForm    = new Account_Form_Address();
        $this->view->contactForm    = new Account_Form_Contact();

        /** Add the profile page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.profile.js' ) );

        $this->view->template->inc_side_overlay = true;
        $this->view->template->inc_sidebar      = true;
        $this->view->template->inc_header       = true;
        $this->view->template->inc_footer       = true;

    }

}

