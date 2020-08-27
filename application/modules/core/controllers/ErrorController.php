<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction ( )
    {
        /**
         * Dev Notes: If we get here, there's a good chance someone typed in some random
         * URL that doesn't route within the application. Because of Tiger's core routing
         * and routes, /abcdefg can be a valid route but will not map to valid modules,
         * controllers or actions. Tiger "sees" the above non-routable URL as
         *
         *     module = abcdefg
         *     controller = index
         *     action = index
         *
         * which is undesirable since there is no abcdefg module.
         */

        Zend_Layout::getMvcInstance()->setLayoutPath( CORE_MODULE_PATH . '/layouts/scripts/');

        $errors = $this->_getParam('error_handler');

        // pr( $errors->type );

        switch ( $errors->type ) {

            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_ACL_NO_RESOURCE:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $priority = Zend_Log::NOTICE;
                $this->forward('error404');
                break;
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_ACL_NOT_AUTHORIZED:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
                $priority = Zend_Log::NOTICE;
                $this->forward('error403');
                break;
            default:
                // application error
                $priority = Zend_Log::CRIT;
                $this->forward('error500');
                break;
        }

        // Log exception, if logger available
//        if ($log = $this->getLog()) {
//            $log->log($this->view->message, $priority, $errors->exception);
//            $log->log('Request Parameters', $priority, $errors->request->getParams());
//        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        // $this->view->message = $errors->message;
        $this->view->request = $errors->request;
    }

    public function getLog ( )
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

    public function error403Action ( )
    {
        // $this->getResponse()->setHttpResponseCode(403);

        // pr( ['403', $this->getRequest()] );

        /**
         * If we're here in the error403 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Page not authorized.';

    }

    public function error404Action ( )
    {
        // $this->getResponse()->setHttpResponseCode(404);

        // pr( ['404', $this->getRequest()] );

        /**
         * If we're here in the error404 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Page not found';

    }

    public function error500Action ( )
    {
        // $this->getResponse()->setHttpResponseCode(500);

        /**
         * If we're here in the error404 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Application error';

    }

}

