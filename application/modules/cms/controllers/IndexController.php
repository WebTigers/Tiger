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
class Cms_IndexController extends Tiger_Controller_Action
{
    public function init()
    {
    }

    public function indexAction ( )
    {
    }

    public function pageAction ( )
    {

        $contentService = new Cms_Service_Content();
        $params = $this->getRequest()->getParams();

        $contentService->setPageContent( $this->view, $params );

    }

    public function sitemapAction ( ) {

        $params = $this->getRequest()->getParams();

        // pr( $params );

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender( true );

        $sitemapService = new Application_Service_Sitemap;
        $body = $sitemapService->getSitemapXML( $params );

        $this->getResponse()->setHeader('Content-Type', 'text/xml; charset=utf-8')->setBody( $body );

    }

}

