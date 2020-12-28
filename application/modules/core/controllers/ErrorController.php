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
 * Class ErrorController
 */
class ErrorController extends Zend_Controller_Action
{

    public function init()
    {

        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        /** Set the OneUI base theme options. */
        $contentService = new Core_Service_Content();
        $contentService->setPageContent( $this->view );

        $this->view->template->inc_side_overlay = '';
        $this->view->template->inc_sidebar      = '';
        $this->view->template->inc_header       = '';
        $this->view->template->inc_footer       = '';

    }

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

        $errors = $this->_getParam('error_handler');

        // pr( $errors );

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
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_ACL:
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

        $this->view->errors = $errors;
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
        $this->getResponse()->setHttpResponseCode(403);

        /**
         * If we're here in the error403 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Page not authorized.';

    }

    public function error404Action ( )
    {
        $this->getResponse()->setHttpResponseCode(404);

        /**
         * If we're here in the error404 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Page not found';

    }

    public function error500Action ( )
    {
        $this->getResponse()->setHttpResponseCode(500);

        /**
         * If we're here in the error404 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Application error';

    }

}

