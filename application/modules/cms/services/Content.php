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

class Cms_Service_Content
{
    use Core_Service_ContentTrait;

    public function setPageContent ( & $view, $params ) {

        # Set the view content from the page data. #
        $pageRow = $this->_getPageRow( $params );

        if ( empty( $pageRow ) ) {
            throw new Zend_Controller_Action_Exception( Zend_Registry::get('Zend_Translate')->translate('ERROR.PAGE_NOT_FOUND'), 404 );
        }

        $view->theme    = $pageRow->theme;
        $view->layout   = $pageRow->layout;

        /** Set the layout path and layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH .'/'. $view->theme . '/layouts/scripts');
        Zend_Layout::getMvcInstance()->setLayout( $view->layout );

        $view->doctype( Zend_View_Helper_Doctype::HTML5 );  // Enables use of certain view helpers.

        $view->headTitle()->set( $pageRow->title );

        /** Set the theme's template option vars (if any), including head links and meta. */
        $this->_setThemeOptions($view, $pageRow );

        /** Set Page Title and Meta, includes OpenGraph and other custom meta. */
        $this->setMeta( $view );

        /** Set Page Links, includes stylesheets, favicons and other non-stylesheet links. */
        $this->setLinks( $view );

        /** Set Inline Scripts */
        $this->setInlineScripts( $view );

        /** Set HeadStyles */
        $this->setStyles( $view );

        /** Set inline JS. */
        $this->setScripts( $view );

        /** Set HeadScripts */
        $this->setHeadScripts($view );

        /** Render the page Content */
        $view->content = Tiger_Template::render( $pageRow->content , [ 'template' => $view->template ] );

    }

    /**
     * @param $view
     * @param $pageRow
     * @throws Zend_Exception
     */
    protected function _setThemeOptions( & $view, $pageRow ) {

        $configOptions = Zend_Registry::get('Zend_Config')->themes->{$pageRow->theme}->options;

        // Instantiating the theme's main template class auto-loads
        // the default and then page override configs, if any. The
        // template can then be used by the layout to set any options.

        $templateClass = ucfirst($view->theme) . "_Service_Template";
        $view->template = new $templateClass;
        $view->template->setTemplateOptions( $configOptions, $pageRow );

    }

    /**
     * Get the page content
     *
     * @param $params
     * @return Zend_Db_Table_Row_Abstract|null
     */
    protected function _getPageRow ( $params ) {

        $pageModel = new Cms_Model_Page;

        if ( ! empty( $params['category'] ) && ! empty( $params['key'] ) ) {

            $category = $params['category'];
            $key = $params['key'];
            $key = preg_replace("/[^a-zA-Z0-9\-](html)/", '', $key);
            return $pageModel->getPageByCategoryKey( $category, $key, true );

        }
        if ( ! empty( $params['key'] ) ) {

            $key = $params['key'];
            $key = preg_replace("/[^a-zA-Z0-9\-](html)/", '', $key);
            return $pageModel->getPageByKey( $key,true );

        }
        elseif ( ! empty( $params['page_id'] ) ) {

            return $pageModel->getPageById( $params['page_id'] );

        }
        else {

            return null;

        }

    }

}