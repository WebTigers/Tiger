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

class Core_Service_Content
{
    use Core_Service_ContentTrait;

    public function setPageContent ( & $view ) {

        /** Set the layout path and layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH .'/'. $view->theme . '/layouts/scripts');
        Zend_Layout::getMvcInstance()->setLayout( $view->layout );

        $view->doctype( Zend_View_Helper_Doctype::HTML5 );  // Enables use of certain view helpers.

        /** Set the theme's template option vars (if any), including head links and meta. */
        $this->_setThemeOptions($view );

        /** Set Page Title. */
        $view->headTitle()->set( $view->title );

        /** Set Meta, includes OpenGraph and other custom meta. */
        $this->setMeta( $view );

        /** Set Links, includes favicons and other non-stylesheet links. */
        $this->setLinks( $view );

        /** Set Inline Scripts. */
        $this->setInlineScripts( $view );

        /** Set HeadStyles. */
        $this->setStyles( $view );

        /** Set inline JS. */
        $this->setScripts( $view );

        /** Set HeadScripts. */
        $this->setHeadScripts($view );

    }

    /**
     * @param $view
     * @param $pageRow
     * @throws Zend_Exception
     */
    protected function _setThemeOptions( & $view ) {

        $configOptions = Zend_Registry::get('Zend_Config')->themes->{$view->theme};

        // Instantiating the theme's main template class auto-loads
        // the default and then page override configs, if any. The
        // template can then be used by the layout to set any options.

        $templateClass = ucfirst($view->theme) . "_Service_Template";
        $view->template = new $templateClass;
        $view->template->setTemplateOptions( $configOptions, null );

    }

}