<?php

class Package_IndexController extends Tiger_Controller_Action
{
    public function init ( )
    {
        parent::init();
    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('package', 'Admin' );
    }

    public function getTokenAction ( ) {

        $responseModel = new Core_Model_ResponseObject([
            'result' => 1,
            'data' => Zend_Registry::get('Zend_Config')->github_oauth->token
        ]);

        header("Access-Control-Allow-Origin: *");
        $this->_helper->json( $responseModel->toArray() );

    }

}

