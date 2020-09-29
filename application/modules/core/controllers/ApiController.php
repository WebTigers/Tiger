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

        $service = new Tiger_Api_ServiceFactory( $this->getRequest() );
        $responseModel = $service->getResponse();

        // header("Access-Control-Allow-Origin: *");
        $this->_helper->json( $responseModel->toArray() );

    }

}

