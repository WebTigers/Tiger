<?php

/**
 * Class ApiController
 */
class ApiController extends Zend_Controller_Action
{

    public function init()
    {
    }

    /**
     * Returns a JSON ResponseModel back to your AJAX call.
     */
    public function apiAction ( ) {

        $service = new Tiger_Api_ServiceFactory( $this->getRequest(), true );
        $responseModel = $service->getResponse();

        // header("Access-Control-Allow-Origin: *");
        $this->_helper->json( $responseModel->toArray() );

    }

}

