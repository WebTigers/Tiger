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
 * Class IndexController
 */
class Docy_IndexController extends Tiger_Controller_Action
{
    public function init()
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'docy';
        $this->view->layout = 'layout';

        /** Set the Kitten base theme options. */
        $contentService = new Core_Service_Content();
        $contentService->setPageContent( $this->view );

    }

    public function indexAction ( )
    {

    }

    public function sampleAction ()
    {
        Zend_Layout::getMvcInstance()->setLayout('fullwidth');
    }

}

