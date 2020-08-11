<?php

abstract class Tiger_Controller_Auth extends Tiger_Controller_Action {
    
    protected $_session;
    protected $_acl;
    protected $_auth;
    protected $_authAdapter;

    protected $_loginForm;
    protected $_signinForm;
    protected $_recoverForm;

    protected $_storage;
    protected $_identity;
    protected $_nid;
    protected $_sessionModel;

    public function init() {
        
        parent::init();
        
        $this->_session         = Zend_Registry::get( 'Zend_Session' );
        $this->_acl             = Zend_Registry::get( 'Zend_Acl' );
        $this->_auth            = Zend_Auth::getInstance();
        $this->_authAdapter     = new Tiger_Auth_DbAdapter;

        $this->_sessionModel    = new Application_Model_Session;
        
        $this->_loginForm       = new Application_Form_Login();
        $this->_signinForm      = new Application_Form_Signin();
        $this->_recoverForm     = new Application_Form_Recover();

        $this->_storage         = $this->_auth->getStorage();
        
        $this->_identity        = ( $this->_auth->hasIdentity() )
                                    ? $this->_auth->getIdentity()
                                    : null;

        Zend_Registry::set( 'Zend_Acl', $this->_acl );

    }
    
    /**
     * This action hook is run autotmatically with each request
     */
    public function preDispatch ( ) {
        
        parent::preDispatch();
        
        // Check to see if this user has been authenticated
        $this->_checkCredentials();

        // Check to see if this user has an NID (NewLIST ID) cookie
        $this->_checkNID();

    }

    /**
     * This action hook is run autotmatically with each request
     */
    public function postDispatch ( ) {
        
        parent::postDispatch();
        
    }
    
    // Authentication Functions //

    /**
     * The NID SuperCookie
     */
    protected function _checkNID() {

        if ( $this->_auth->getIdentity()->role !== 'guest' ) {

            $this->_nid = $this->_auth->getIdentity()->user_id;

        }
        else {

            $this->_nid = ( isset($_COOKIE['NID']) && Tiger_Utility_Uuid::is_valid($_COOKIE['NID']) )
                ? $_COOKIE['NID']
                : Tiger_Utility_Uuid::v4();

        }

        Zend_Registry::set('NID', $this->_nid);
        setcookie('NID', $this->_nid, time() + (3600 * 24 * 365));
        
    }

    /**
     * Check Credentials is called during the pre dispatch hook right before 
     * we are about to execute our action. At this point, we should know everything
     * about where the request is heading and who is attempting to head there, either
     * from an existing auth persisted within the session or via params passed in.
     * 
     * Calling checkCredentials here keeps us from having to install this one
     * line of code throughout all of the controllers, which is a pain and makes
     * for very bad code maintenance. Since ALL of the controllers inherit from
     * this class, these functions will be called automagically.
     * 
     * JARVIS assigns EVERYONE credentials who enters the application. If we 
     * don't have a proper identity at this point, we'll create a "guest" identity.
     * 
     * The ACCOUNT / LOGIN action is specifically setup to allow users to establish 
     * an identity and persist it within a session.
     * 
     * If we pass in AUTOAUTH params, we will authecticate using those credentials
     * but those credentials are stateless, they are not persisted within the session.
     * As such, AutoAuth calls need to pass credentials on every call.
     * 
     */
    protected function _checkCredentials() {
        
        // Zend_Auth will automatically know if we have a valid identity from 
        // the session on instantiation of this class. If we don't have an identity,
        // then we attempt to create one using the Tiger_Auth_DbAdapter class.
        // If we are making an ajax call, we always re-authenticate.
        
        if ( ! $this->_auth->hasIdentity() ) { $this->_login(); }
        
        // The login method WILL provide us with an identity every time, whether
        // that identity is a logged-in user or a non-logged-in guest. Not that
        // we have a user, we can look at the role of that user and either accept
        // or reject where they are attemtping to go within JARVIS.
        
        // Pulled this out into a variable for easier debugging.
        
        $allowed = $this->_acl->isAllowed( 
                $this->_auth->getIdentity()->role, 
                $this->_request->getControllerName(), 
                $this->_request->getActionName() 
            );
        
        if ( ! $allowed ) { 
            
            // Remember where we are going, after we login, we can go 
            // directly there. The easiest way is to just remember the
            // request object.
            
            $request = $this->getRequest();

            if ( $request->getActionName() === null ) {
                $request->setActionName('index');
            }

            Zend_Registry::get('Zend_Session')->aclRequest = $request;
            
            // TigerTRAX
            Tiger_Trax_Tracker::find( 'action_not_allowed.login.auth' );
            $jsonData = Zend_Json::encode( $request->getParams() );
            Tiger_Trax_Tracker::track('action_not_allowed.login.auth', 5, 31, null, $jsonData);
            
            $data = $request->getParams();
            $data['error_status'] = 3; // 3 = Permission Denied
            
            $this->_loginError( $data ); 
            
        }

        // We can push this auth stuff out to all of the views, but that doesn't mean that we need to display all of it.
        $this->_setViewOrgUser();

        // Update the Session Reminder cookie so we know when our session will expire.
        $this->_setSessionReminder();

    }

    protected function _setViewOrgUser () {

        $this->view->user_id                    = $this->_storage->read()->user_id;
        $this->view->username                   = $this->_storage->read()->username;
        $this->view->role                       = $this->_storage->read()->role;
        $this->view->user_display_name          = $this->_storage->read()->user_display_name;
        $this->view->first_name                 = $this->_storage->read()->first_name;
        $this->view->last_name                  = $this->_storage->read()->last_name;

        if ( ! in_array( $this->_storage->read()->role, ['user','guest'] ) ) {

            $this->view->company_title              = $this->_storage->read()->company_title;
            $this->view->customer_id                = $this->_storage->read()->customer_id;
            $this->view->account_id                 = $this->_storage->read()->account_id;

            $this->view->org_id                     = $this->_storage->read()->org_id;
            $this->view->orgname                    = $this->_storage->read()->orgname;
            $this->view->org_display_name           = $this->_storage->read()->org_display_name;

            $this->view->parent_org_id              = $this->_storage->read()->parent_org_id;
            $this->view->parent_orgname             = $this->_storage->read()->parent_orgname;
            $this->view->parent_org_display_name    = $this->_storage->read()->parent_org_display_name;

        }

    }

    // Authentication Helper Functions //
    
    public function loginAction ( ) {
        
        $this->_loginForm   = ( $this->getRequest()->isXmlHttpRequest() ) 
                                ? $this->_signinForm 
                                : $this->_loginForm;
        
        // $this->view->login_form = $this->_loginForm;
        
        // Set any flashMessages sitting in the queue. If no flash
        // messages exist, will return an empty array().
        
        if ( $this->flashMessenger->hasMessages() ) {
            $this->setMessages( $this->flashMessenger->getMessages() );
        }

        // Checks for and handles login post. Will redirect to the
        // proper page if there is a successful or bad login attempt.
        
        $this->_login();
        
        if ( $this->getRequest()->isXmlHttpRequest() ) {
            
            $response = $this->_storage->read();
            
            // pr( Zend_Auth::getInstance()->getIdentity()->role );
            
            // Since this is an ajax call, send the contenxt menu
            // markup to install into the DOM
            $response->menu = $this->_getMenu();
            
            // Tell the UI whether or not to show the reCaptcha widget
            $response->showReCaptcha = $this->_loginForm->reCaptchaRequired();
            $response->errors = $this->_loginForm->getErrors();
            
            // Grab any login messages and then clear them since this is an AJAX call
            $response->messages = $this->flashMessenger->getCurrentMessages();
            $this->flashMessenger->clearCurrentMessages();

            // header("Access-Control-Allow-Origin: *");
            
            // Let Zend output the JSON response
            $this->_helper->json( $response );
            
        } else {

            // This is available on every page.
            // $this->view->inlineScript()->appendFile( '/themes/zen3/default/account/login/jquery.newList.Login.js' );
            $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/account/login/jquery.newList.Login.js' ) );
            $this->view->login_form = $this->_loginForm;
            
        }

    }

    public function logoutAction ( ) {
        
        $this->_auth->clearIdentity();
        $this->_getGuestCredentials();
        
        // Set a logout message
        $this->setMessages( array( $this->createHTMLMessage( $this->translate->_( 'account.logout.logged_out' ) ) ) );

    }

    protected function _setSessionData () {

        /**
         * This function is called to set certain searchable data in the session table
         * after login.
         */

        try {

            $session_id = Zend_Session::getId();
            $identity = $this->_auth->getIdentity();

            $sessionRow = $this->_sessionModel->fetchRow( $this->_sessionModel->select()->where('session_id = ?', $session_id) );

            if ( ! empty($sessionRow) ) {

                $sessionRow->user_id    = $identity->user_id;
                $sessionRow->username   = $identity->username;
                $sessionRow->org_id     = $identity->org_id;
                $sessionRow->orgname    = $identity->orgname;

                $sessionRow->save();

            }
        }
        catch ( \Exception $e ) {

            // pr( $e->getMessage() );

        }

    }

    public function getLoginStatusActionOFF () {

        $identity = null;
        
        if ( $this->_auth->hasIdentity() ) {

            $data = $this->_auth->getIdentity();
            
        }

        $data = Zend_Session::getId();

        // $data = Zend_Registry::get('Zend_Session')::sessonExists();
        
        // Let Zend output the JSON response
        $this->_helper->json( $data );
        
    }

    protected function _getMenu ( ) {
        
        $mainmenu = $this->view->navigation()->findById('main');

        // Remove the login and logout pages for Zen3
        $page = $mainmenu->findById('login');
        $mainmenu->removePage($page);
        $page = $mainmenu->findById('logout');
        $mainmenu->removePage($page);
        return $this->view->navigation()->menu()->
                renderPartial($mainmenu, array('mainmenu.phtml', 'default'));
        
    }

    /**
     * The _login() helper function off loads the heavy lifting of doing logins
     * and places that duty in one easy to reach place. To login we need two or
     * three pieces of data, depending on the type of authentication we are doing.
     * 
     * JARVIS recognizes two kinds of authentication, UserAuth and AutoAuth.
     * 
     * UserAuth - is when the user manually logs in via the login page. This
     * creates the typical user session. The required pieces of data are a
     * username and password. If the UserAuth login attempt fails more than X
     * times, JARVIS will ask for a CAPTCHA field as well.
     * 
     * AutoAuth - is when some other application attempts to talk to JARVIS,
     * usually via the MAJAX form post. This connection is stateless, meaning
     * that every request needs to have credentials sent, or the request will
     * fail. AutoAuth requires three pieces of data to login: 
     * 
     *      username    - in the form of a UUID user_id, 
     *      password    - a sha1 hash of the user_id + timestamp + autoauthkey
     *      timestamp   - standard UNIX timestamp
     * 
     * The username must be a valid UUID for JARVIS to attempt to authenticate
     * via AutoAuth. The password must be a sha1 hash of the user_id, timestamp,
     * and autoauthkey.
     * 
     *      autoauthkey - is a shared secret key between JARVIS and the external 
     *                    system. You don't talk to JARVIS without this key.
     * 
     * The timestamp must be within +/- 15 minutes of the current time for the
     * credentials and hash to be accepted.
     */
    
    protected function _login ( ) {

        // LISTEN UP: The ONLY reason we are here is because we don't have a
        // valid identity already. JARVIS doesn't know who is making the 
        // request. We are about to find out!
        
        $request = $this->getRequest ( );

        // If you didn't post any data and you hit a page without an indentity
        // then you are a guest, period. Congratulations, you automatically
        // get guest credentials. Your NID will be your user_id and we know
        // your IP address.
        
        if ( $request->isPost() ) {

            $post = $request->getPost();
            
            // A bit of a hack here for Webhook Requests
            $webhookCall = false;
            if ( isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ) {
                $post['username'] = $_SERVER['PHP_AUTH_USER']; 
                $post['password'] = $_SERVER['PHP_AUTH_PW'];
                $webhookCall = true;
            }
            
            // Page requests will not always have username and password credentials, 
            // but they are requred fields. If we don't see these in the post, just
            // then don't even bother authenticating, just establish a guest user.
            
            if ( isset($post['username']) && isset($post['password']) ) {
                
                // Don't run ReCaptcha, it's a  Webhook call
                if ( $webhookCall ) {
                    $this->_loginForm->requireReCaptcha( false );
                }
                
                // A little data massaging if we're using reCaptcha and an actual form post.
                // @TODO: Make all form posts into Ajax requests at some point.
                if ( isset( $post['g-recaptcha-response'] ) ) {
                    $post['recaptcha'] = $post['g-recaptcha-response'];
                    unset( $post['g-recaptcha-response'] );
                }
                
                if ( $this->_loginForm->isValid( $post ) ) {

                    $data = $this->_loginForm->getValues();

                    $this->_authAdapter
                            ->setIdentity  ( $data['username']  )
                            ->setCredential( $data['password']  );

                    $result = $this->_authAdapter->authenticate();

                    // Okay, the moment of truth. Either auth succeeded or it failed.
                    // A failed auth here means that someone posted bad creds. However,
                    // if this is an AutoAuth call we don't want to redirect to the 
                    // login page. If the result is flagged as AutoAuth (ie. the username 
                    // is a valid UUID, then toss back a JSON error reposne.

                    if ( $result->isValid() ) {

                        if ( ! $this->getRequest()->isXmlHttpRequest() && ! $webhookCall ) {

                            $this->_loginSuccess( $data ); 

                        } else {

                            $this->_getAuthCredentials();

                        }

                    } else {

                        // If you get here, it's a bad thing. You posted credentials
                        // and we could not verify those credentials against the user
                        // table. You might be someone trying to break into JARVIS.
                        // You're now being tracked, Bubba ...

                        $data['error_status'] = 2; // 2 = Login Failed

                        // TigerTRAX
                        Tiger_Trax_Tracker::find( 'failed_authentication.login.auth' );
                        $jsonData = Zend_Json::encode( $data );
                        Tiger_Trax_Tracker::track('failed_authentication.login.auth', 5, 31, null, $jsonData);

                        $this->_loginError( $data );

                    }

                } else {

                    // The reason we're here is because we don't have an identity and
                    // we likely made a form post via ajax without a valid username 
                    // and password. @TODO: Need to handle this better ...

                    $post['error_status'] = 1;  // 1 = Failed Validation

                    // TigerTRAX
                    Tiger_Trax_Tracker::find( 'failed_validation.login.auth' );
                    $jsonData = Zend_Json::encode( $post );
                    Tiger_Trax_Tracker::track('failed_validation.login.auth', 5, 31, null, $jsonData);

                    $this->_loginError( $post );

                }
                
            } else {
                
                // Okay, so if we get here it's because we don't have an identity and 
                // we didn't post any credentials to ask for one. So, we have a guest 
                // user. Assemble an identity object with the role as 'guest' and move 
                // on. The guest credentials will persist until the session expires or 
                // they actually login.

                $this->_getGuestCredentials();
                
            }
            
        } else {
            
            // Okay, so if we get here it's because we don't have an identity and 
            // we didn't post any credentials to ask for one. So, we have a guest 
            // user. Assemble an identity object with the role as 'guest' and move 
            // on. The guest credentials will persist until the session expires or 
            // they actually login.
            
            $this->_getGuestCredentials();
            
        }
        
    }
    
    protected function _getGuestCredentials ( ) {
        
        $userData['org_id']                     = '0';
        $userData['orgname']                    = 'guest';
        $userData['org_display_name']           = 'Guest';
        
        $userData['parent_org_id']              = '0';
        $userData['parent_orgname']             = 'guest';
        $userData['parent_org_display_name']    = 'Guest';
        
        $userData['user_id']                    = $this->_nid;
        $userData['username']                   = 'guest';
        $userData['user_display_name']          = 'Guest User';
        
        $userData['first_name']                 = 'Guest';
        $userData['last_name']                  = 'User';
        $userData['company_title']              = '';
        
        $userData['email']                      = '';
        $userData['role']                       = 'guest';
        $userData['ip_address']                 = $_SERVER['REMOTE_ADDR'];
        
        $userData['customer_id']                = null;
        
        $this->_storage->write( (object) $userData );
        
    }

    protected function _getAuthCredentials ( ) {
        
        $userRow = $this->_authAdapter->getUser();

        $user = new Application_Model_User;

        if ( $userRow->role === 'user' ) {
            
            $userData = $this->_authAdapter->getResultRowObject(array(
                'user_id',
                'username',
                'user_display_name',
                'first_name',
                'last_name',
                'email',
                'role',
                'locale_preference',
            ));

            $orgRow  = $user->getOrgByUserId( $userData->user_id );

            $userData->org_id                   = $orgRow->org_id;
            $userData->orgname                  = $orgRow->orgname;
            $userData->org_display_name         = $orgRow->org_display_name;

        }
        else {
        
            // Store some additional convenience data in the auth object

            $userData = $this->_authAdapter->getResultRowObject(array(
                'user_id',
                'username',
                'user_display_name',
                'first_name',
                'last_name',
                'company_title',
                'email',
                'role',
                'locale_preference',
                'customer_id',
                'account_id',
            ));

            // Add Org data for convenience
            $orgRow  = $user->getOrgByUserId( $userData->user_id );

            // The org_id and parent_org_id will be the same unless the user is
            // impersonating (managing) the org, in which case the parent_org_id 
            // will be the org that the user actually belongs to. The org_id can be
            // changed and updated in the authentication object when the user hits 
            // the admin > manage clients page.

            // Note that we don't ever just login as a user within a foreign org_id.
            // No. We login as our org/user and then, if we have permissions, we then
            // impersonate a child org_id using the admin > manage clients page.

            $userData->org_id                   = $orgRow->org_id;
            $userData->orgname                  = $orgRow->orgname;
            $userData->org_display_name         = $orgRow->org_display_name;

            $userData->parent_org_id            = $orgRow->org_id;
            $userData->parent_orgname           = $orgRow->orgname;
            $userData->parent_org_display_name  = $orgRow->org_display_name;
        
        }

        $userData->remember = ( $this->getRequest()->getParam('remember') ) ? '1' : '0';

        $this->_storage->write( $userData );

        $this->_setLocalePreference();
        $this->_setSessionData();
        $this->_setSessionReminder();
        
    }
    
    // Non-ajax Login //
    
    protected function _loginSuccess( $data ) {
        
        $this->_getAuthCredentials();
        
        // Set success FlashMessage
        $message = sprintf($this->translate->_('form.login.welcome_message'), $this->_storage->read()->user_display_name);

        $this->flashMessenger->addMessage($this->createHTMLMessage($message, 'success'));

        if ($data['remember'] === '1') {
            $this->_setRememberMe($this->_storage->read()->username);
        }

        // Remove any Tiger Trax
        Tiger_Trax_Tracker::expire( 'excessive_attempts.login.auth' );
        Tiger_Trax_Tracker::expire( 'failed_authentication.login.auth' );
        Tiger_Trax_Tracker::expire( 'failed_validation.login.auth' );
        
        if ( isset( $this->_session->aclRequest ) &&
                $this->_session->aclRequest->getActionName() !== 'logout' && 
                $this->_session->aclRequest->getActionName() !== 'ajax' ) {

            $aclRequest = $this->_session->aclRequest;
            unset( $this->_session->aclRequest );

            // Report, Location, Image, and Ad all have their own controllers and run off of the index action
            // which ZF just leaves empty. If we encounter an empty action, it's likely because we attempted
            // to reach one of the above index actions.

            if ( $aclRequest->getActionName() === 'index' && in_array( $aclRequest->getControllerName(), ['report', 'location', 'image', 'ad'] ) ) {

                $uri = $this->getFrontController()->getRouter()->assemble([
                    'module'        => 'default',
                    'controller'    => 'account',
                    'action'        => $aclRequest->getControllerName(),
                ]);

            }
            else {

                $uri = $this->getFrontController()->getRouter()->assemble([
                    'module'        => 'default',
                    'controller'    => $aclRequest->getControllerName(),
                    'action'        => $aclRequest->getActionName(),
                ]);

            }

        } else {

            // Redirect to the index page
            $uri = $this->getFrontController()->getRouter()->assemble([
                'module'        => 'default',
                'controller'    => 'account',
                'action'        => 'dashboard',
            ]);

        }

        $this->redirect( $uri );

    }

    protected function _loginError ( $post ) {
        
        $this->_getGuestCredentials();
        
        // Cancel Remember Me
        $this->_setRememberMe();
        
        // Set invalid FlashMessage
        foreach ( $this->_loginForm->getMessages() as $element => $messages ) {
            foreach ( $messages as $message ) {
                $this->flashMessenger->addMessage( $this->createHTMLMessage( $message, 3 ) );
            }
        }

        // Sometimes we don't have a login error, it's just an expired session. 
        // We want to play nice with the error messages.  :)


        $errorCode = intval( $post['error_status'], 10 );
        
        $error_codes = array(
            'unknown',
            'account.loginError.unknown',
            'account.loginError.invalid',
            'account.loginError.sessionExpired',
            'account.authentication.accessDenied',
        );
        $loginError = $error_codes[ $errorCode ];

        $this->flashMessenger->addMessage( $this->createHTMLMessage( $loginError, 3 ) );

        // Redirect if this isn't an ajax request
        if ( ! $this->getRequest()->isXmlHttpRequest() ) {
            
            // Redirect to the login page for flash message and cookie reset
            $this->redirect( '/account/login' );
        
        }
        
    }
    
    protected function _setRememberMe( $username = null ) {
        
        // (Re)Set the Remember Me cookie for 30 days, if checked
        
        $time = ( !is_null($username) ) ? time()+3600*24*30 : time()+3600*24*30*-1;
        
        if ( ! is_null( $username ) ) { $_COOKIE['username'] = $username; }
        
        setcookie(
            'username',     // name
            $username,      // $value = null
            $time,          // $expire = 0
            '/',            // $path = null
            null,           // $domain = null
            false,          // $secure = false
            false           // $httponly
        );
        
    }

    protected function _setSessionReminder ( ) {

        $time = time() + $this->_config->account->login->timeout;

        setcookie(
            'session_reminder',     // name
            $time,                  // $value = null
            $time,                  // $expire = 0
            '/',                    // $path = null
            null,                   // $domain = null
            false,                  // $secure = false
            false                   // $httponly
        );

    }

    protected function _setLocalePreference ( ) {



    }

}
