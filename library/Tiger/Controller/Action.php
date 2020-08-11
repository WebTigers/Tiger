<?php

abstract class Tiger_Controller_Action extends Zend_Controller_Action {

    protected $_config;
    
    public $theme;
    public $module;
    public $layout;
    
    public $redirector;
    public $translate;
    public $flashmessenger;
    
    public $headerVars; // associative array
    public $footerVars; // associative array
    
    public $ajax; // global ajax var storage
    
    public function init ( ) {
        
        parent::init();
        
        $this->_config          = Zend_Registry::get( 'Zend_Config' );
        
        // Log the application - for debugging purposes
        // Tiger_Log::db( 'backtrace', Tiger_Log::trace() );
        
        // Check to see if we're forcing SSL
        $this->checkSSL();

        // Instantiate the redirector helper
        $this->redirector       = $this->_helper->getHelper( 'Redirector' );
        
        // Instantiate the flashmessenger
        $this->flashMessenger   = $this->_helper->getHelper( 'FlashMessenger' );
        Zend_Registry::set('FlashMessenger', $this->flashMessenger);  // Allows us to grab this anywhere now.
        
        // Get an instance of Zend Translate
        $this->translate        = Zend_Registry::get( 'Zend_Translate' );
        
        // set the theme and module convenience properties
        $this->theme            = $this->_helper->layout()->getView()->theme;
        $this->module           = $this->getRequest()->getModuleName();
        
        // @TODO: This whole layout setting is totally static now, not based on
        // the module. Need to fix this at some point! ~ Beau
        $this->layout           = Zend_Registry::get('Zend_Config')->resources->layout->layout;
        
    }
    
    /**
     * 
     */
    public function preDispatch ( ) {
        
        parent::preDispatch();
        
        // $route = $this->getRequest()->getControllerName();
        // $route = $this->getFrontController()->getControllerDirectory();
        // pr( $route );
        
    }

    /**
     * 
     */
    public function postDispatch ( ) {
        
        parent::postDispatch();
        
        // Okay, so here's the deal, when the site goes into maintenance mode, we
        // want the outside world to see the "Maintenance" screen, but we don't
        // want our development staff to see this screen. We want to see if the
        // site is up and working properly until maintenance is turned off.
        
        if ( APPLICATION_MAINT === true && 
                ! in_array( $_SERVER['REMOTE_ADDR'], $this->_config->development_ips->toArray() ) ) {
            
            $this->setLayout( 'maintenance' );
            
        } else {
        
            // set the default header and footer in the layout
            $this->view->layout()->header = $this->view->partial( 'header.phtml', $this->headerVars );
            $this->view->layout()->footer = $this->view->partial( 'footer.phtml', $this->footerVars );
        
        }
        
    }
    
    public function checkSSL ( ) {

        if ( isset( $_SERVER['HTTP_HOST'] ) ) {

            if (intval($this->_config->forceSSL) === 1 && HTTPS === false) {
                header("Status: 301 Moved Permanently");
                header(sprintf(
                    'Location: https://%s%s', $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']
                ));
                exit();
            }
        }
        else {
            exit();
        }

    }

    /**
     * A convenience function to easily set the layout
     * 
     * In Zend, a layout is simply a wrapper for the view.
     * 
     * @param string $layout
     * @return void 
     */
    public function setLayout( $layout ) {
        
        $this->_helper->layout()->setLayout( $layout );
        
    }

    protected function _setCDNPaths () {
        
        // This only works the way it's supposed to if one is logged in. Don't 
        // use this for public sites where the user is guest.
        
        // Example URI: bucket/org_id/ 
        // http://0.cdn.newlist.com/72fdf772-f326-4126-ab8d-965d1e192be0/
        // or
        // https://d2trljilq5f4b9.cloudfront.net/72fdf772-f326-4126-ab8d-965d1e192be0/
        
        $cdn = substr( $this->_identity->org_id, -1 ) . '.' . $this->_config->resources->view->cdn;
        
        $cfa = $this->_config->net->cloudfront->toArray();
        $cfn = array_flip( $cfa );
        
        $this->view->CDN = $cdn . '/' . $this->_identity->org_id . '/';
        $this->view->CFN = $cfn[$cdn] . '.cloudfront.net/' . $this->_identity->org_id . '/';
        
    }

    /**
     * Convenience function to set placeholder for messages.
     * 
     * @param type $messages
     */
    public function setMessages ( $messages ) {
        
        $messageStr = $messages;
        
        if ( ! empty( $messages ) && is_array( $messages ) ) {
            $messageStr = implode( '', $messages );
        }
        
        $this->view->placeholder('messages')->set( $messageStr );
        
    }    

    /**
     * Creates a message string with the appropriate decorator tags
     * from a message object or from a string.
     * 
     *      object (
     *          message => "Some kind of message!",
     *          class   => "success"
     *      )
     * 
     * Note that this function also lives in the base Application_Model_ResponseObject.
     * 
     * @param mixed $message object or sting
     * @param mixed $type (see switch statement for types)
     * @return string '<div class="alert alert-info"><i class="fa fa-info-circle"></i> &nbsp;Some translated message.</div>'
     */
    public function createHTMLMessage ( $message, $type = 3 ) {
        
        $out_message    = ( is_object( $message ) ) ? $message->message : $message;
        $out_type       = ( is_object( $message ) ) ? $message->class   : $type;

        switch ( $out_type ) {
            
            case 3:
            case 'alert':
                $class = 'alert alert-warning';
                $icon  = 'fa fa-warning';
                break;

            case 2:
            case 'error':
                $class = 'alert alert-danger';
                $icon  = 'fa fa-ban';
                break;

            case 1:
            case 'success':
                $class = 'alert alert-success';
                $icon  = 'fa fa-check';
                break;
            
            case 0:
            case 'info':
            default :
                $class = 'alert alert-info';
                $icon  = 'fa fa-info-circle';
                break;
            
        }
        
        
        return '<div class="' . $class . '"><i class="' . $icon . '"></i> &nbsp;' . $this->translate->_( $out_message ) . '</div>';
        
    }
    
    /**
     * Not sure if I want to mess with this at this point ... -Beau
     * 
     * Sets the page messages from a Zend Form. Accepts an array of Zend Form
     * messages and parses them into an array that can then be sent to the
     * standard setMessages() function.
     * 
     * @param array of Zend Form Messages 
     * @return array of Message objects
     */
    public function setMessagesFromForm ( $messages ) {
        
        $out = '';
        if (is_array($messages) && !empty($messages)) {
            foreach($messages as $message) {
                $out .= $this->createHTMLMessage( $message->message, $message->class );
            }
        }
        
        $this->view->placeholder('messages')->set($out);
        
        return $out;
        
    }
    
    /**
     * Within ZendTiger, AJAX requests are typically handled as a form post with
     * a Zend Form object, validation, filtering and full security. Post your
     * request to this ajaxAction() and ZendTiger does the rest. Sweet! :D
     * 
     * Within the request, you must pass in params the factory can use to instatiate
     * the service and process the request:
     * 
     * module_     - (optional) the module name where the controller or service 
     *               lives, use "module_" because the request object already uses 
     *               "module" and will overwrite the "module" param. (optional) 
     *               Defaults to the "default" module.
     * controller_ - (optional) the controller if calling a controller action.
     *               Defaults to "index".
     * action_     - (optional) the action if calling a controller. Remember, 
     *               we're returning ajax JSON data so make sure your action knows
     *               to return JSON data. Defaults to "ajax".
     * service     - (required) the service name we're calling
     * method      - (required) the method name within the service
     * param1      - (optional) the params our service method is expecting, this 
     *               could be an object
     * param2
     * param3
     * etc...
     * 
     */
    public function ajaxAction ( ) {
        
        // pr( $this->getRequest()->getParams() );
        
        $module     = $this->getRequest()->getParam( 'module_' );
        $controller = $this->getRequest()->getParam( 'controller_' );
        $action     = $this->getRequest()->getParam( 'action_' );
        
        if ( ! is_null( $module ) || ! is_null( $controller ) || ! is_null( $action ) ){
            
            // @TODO: This isn't working yet, not sure why. -Beau
            $this->forward( $action, $controller, $module, $this->getRequest()->getParams() );
            
        } else {
        
            // Just toss the request into the factory
            $ajax = new Tiger_Ajax_ServiceFactory( $this->getRequest(), true );
            $this->ajax = $ajax->getResponse();
            
        }
        
        header("Access-Control-Allow-Origin: *");
        
        // Let Zend output the JSON response
        $this->_helper->json( $this->ajax );

    }

}
