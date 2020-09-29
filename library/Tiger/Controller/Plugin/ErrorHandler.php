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

class Tiger_Controller_Plugin_ErrorHandler extends Zend_Controller_Plugin_ErrorHandler
{
    const EXCEPTION_ACL = 'EXCEPTION_ACL';
    const EXCEPTION_ACL_NO_RESOURCE = 'EXCEPTION_ACL_NO_RESOURCE';
    const EXCEPTION_ACL_NOT_AUTHORIZED = 'EXCEPTION_ACL_NOT_AUTHORIZED';

    public function __construct( Array $options = array() ) {

        parent::__construct( $options );

    }

    /**
     * Handle errors and exceptions
     *
     * If the 'noErrorHandler' front controller flag has been set,
     * returns early.
     *
     * @param  Zend_Controller_Request_Abstract $request
     * @return void
     */
    protected function _handleError( Zend_Controller_Request_Abstract $request )
    {
        $frontController = Zend_Controller_Front::getInstance();
        if ($frontController->getParam('noErrorHandler')) {
            return;
        }

        $response = $this->getResponse();

        if ($this->_isInsideErrorHandlerLoop) {
            $exceptions = $response->getException();
            if (count($exceptions) > $this->_exceptionCountAtFirstEncounter) {
                // Exception thrown by error handler; tell the front controller to throw it
                $frontController->throwExceptions(true);
                throw array_pop($exceptions);
            }
        }

        // check for an exception AND allow the error handler controller the option to forward
        if (($response->isException()) && (!$this->_isInsideErrorHandlerLoop)) {
            $this->_isInsideErrorHandlerLoop = true;

            // Get exception information
            $error            = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
            $exceptions       = $response->getException();
            $exception        = $exceptions[0];
            $exceptionType    = get_class($exception);
            $error->exception = $exception;

            switch ($exceptionType) {

                case 'Zend_Controller_Router_Exception':
                    if (404 == $exception->getCode()) {
                        $error->type = self::EXCEPTION_NO_ROUTE;
                    } else {
                        $error->type = self::EXCEPTION_OTHER;
                    }
                    break;

                case 'Zend_Controller_Dispatcher_Exception':
                    $error->type = self::EXCEPTION_NO_CONTROLLER;
                    break;

                case 'Zend_Controller_Action_Exception':
                    if (404 == $exception->getCode()) {
                        $error->type = self::EXCEPTION_NO_ACTION;
                    } else {
                        $error->type = self::EXCEPTION_OTHER;
                    }
                    break;

                case 'Tiger_Exception_AclNoResource':
                    $error->type = self::EXCEPTION_ACL_NO_RESOURCE;
                    break;

                case 'Tiger_Exception_AclNotAuthorized':
                    $error->type = self::EXCEPTION_ACL_NOT_AUTHORIZED;
                    break;

                case 'Tiger_Exception_Acl':
                    $error->type = self::EXCEPTION_ACL;
                    break;

                default:
                    $error->type = self::EXCEPTION_OTHER;
                    break;

            }

            // Keep a copy of the original request
            $error->request = clone $request;

            // get a count of the number of exceptions encountered
            $this->_exceptionCountAtFirstEncounter = count($exceptions);

            // Forward to the error handler
            $request->setParam('error_handler', $error)
                ->setModuleName($this->getErrorHandlerModule())
                ->setControllerName($this->getErrorHandlerController())
                ->setActionName($this->getErrorHandlerAction())
                ->setDispatched(false);

        }

    }

}