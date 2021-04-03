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
    protected $translate;

    public function init()
    {
        $this->_translate = Zend_Registry::get('Zend_Translate');
    }

    public function indexAction ( )
    {
        if ( isset( Zend_Registry::get('Zend_Config')->tiger->cms->default_home_page_id ) ){
            $this->getRequest()->setParam('page_id', Zend_Registry::get('Zend_Config')->tiger->cms->default_home_page_id);
            $this->forward('page');
        }
        else {
            throw new Zend_Controller_Action_Exception( $this->_translate->translate('ERROR.PAGE_NOT_FOUND'), 404 );
        }

    }

    public function pageAction ( )
    {

        $contentService = new Cms_Service_Content();
        $params = $this->getRequest()->getParams();

        // pr( $params );

        $contentService->setPageContent( $this->view, $params );

    }

    public function docsAction ( )
    {

        $contentService = new Cms_Service_Content();
        $params = $this->getRequest()->getParams();

        // pr( $params );

        $contentService->setPageContent( $this->view, $params );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version('/assets/cms/js/cms.tiger.docs.js' ) );

        // pr( $this->view->template );

    }

    public function sitemapAction ( ) {

        $params = $this->getRequest()->getParams();

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender( true );

        $sitemapService = new Application_Service_Sitemap;
        $body = $sitemapService->getSitemapXML( $params );

        $this->getResponse()->setHeader('Content-Type', 'text/xml; charset=utf-8')->setBody( $body );

    }

}

