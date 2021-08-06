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

        $this->view->template->name = Zend_Registry::get('Zend_Translate')->translate( Zend_Registry::get('Zend_Config')->tiger->platform->name );
        $this->view->template->version = Zend_Registry::get('Zend_Config')->tiger->platform->version;

        /** This makes use of the default manage branch of the menu tree. */
        $this->view->template->menu = 'account';

        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/account/css/account.css' ) );

    }

    ### Public Actions ###

    public function indexAction ( )
    {
        $this->forward('dashboard' );

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

    public function signupAction ( )
    {
        /** Remove the backend theme includes. */
         $this->view->template->inc_side_overlay = false;
         $this->view->template->inc_sidebar      = false;
         $this->view->template->inc_header       = false;
         $this->view->template->inc_footer       = false;

        /** Add the tigerPassword widget. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerPassword.js' ) );

        /** Add the signup page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.signup.js' ) );

        /** Set the signup form into the view. */
        $this->view->signupForm = new Account_Form_Signup();

        /** Do some referral and org pre-processing of the request and form. */
        $this->_setSignupFormValues();

    }

    protected function _setSignupFormValues()
    {

        $params = $this->getRequest()->getParams();

        if ( ! empty( $params['org_referral_code'] ) ) {
            $this->view->signupForm->org_referral_code->setValue( $params['org_referral_code'] );
        }

        if ( ! empty( $params['user_referral_code'] ) ) {
            $this->view->signupForm->user_referral_code->setValue( $params['user_referral_code'] );
        }

        if ( ! empty( $params['orgname'] ) ) {
            if ( Zend_Validate::is( $params['orgname'], 'Alnum') ) {

                $this->view->signupForm->orgname->setValue( $params['orgname'] );
                $orgModel = new Account_Model_Org();
                $orgRow = $orgModel->getOrgByName( $params['orgname'] );
                if ( ! empty( $orgRow ) ) {
                    $this->view->org = (object) $orgRow->toArray();
                }

            }
        }

    }

    public function welcomeAction ( )
    {
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

        /** Add the welcome page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.welcome.js' ) );

        $this->view->user = Zend_Auth::getInstance()->getIdentity();

        $resendForm = new Account_Form_Resend();
        $resendForm->getElement('user_id')->setValue( $this->view->user->user_id );
        $this->view->resendForm = $resendForm;

    }

    public function loginAction ( )
    {
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

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
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

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
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

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
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

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
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

        $this->view->loginForm = new Account_Form_Login();
        $this->view->loginForm->getElement('username')->setAttrib('placeholder', $this->view->translate('RECOVER.USERNAME_EMAIL'));

        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.recover.js' ) );

    }

    public function passwordAction ( )
    {
        /** Remove the backend theme includes. */
        $this->view->template->inc_side_overlay = false;
        $this->view->template->inc_sidebar      = false;
        $this->view->template->inc_header       = false;
        $this->view->template->inc_footer       = false;

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
        if ( Zend_Registry::get('Zend_Acl')->isAllowed( $role, 'Account_Controller_Account', 'dashboard' ) ) {
            $this->forward('dashboard', 'account', 'account');
        }
        else {
            $this->forward('recover');
        }

    }

    public function profileAction ( )
    {
        $this->view->userForm       = new Account_Form_User();
        $this->view->avatarForm     = new Account_Form_Avatar();
        $this->view->orgForm        = new Account_Form_Org();
        $this->view->addressForm    = new Account_Form_Address();
        $this->view->contactForm    = new Account_Form_Contact();

        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/dropzone/dist/min/dropzone.min.css' ) );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/vendor/clipboardJS/dist/clipboard.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/dropzone/dropzone.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerPassword.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.profile.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.profile.avatar.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.org.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.address.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.contact.js' ) );

        $this->view->template->inc_side_overlay = true;
        $this->view->template->inc_sidebar      = true;
        $this->view->template->inc_header       = true;
        $this->view->template->inc_footer       = true;

    }

}

