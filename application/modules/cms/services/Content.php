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

    public function setPageContent ( & $view, $params ) {

        # Set the view content from the page data. #
        $pageRow = $this->_getPageRow( $params );

        $view->theme    = $pageRow->theme;
        $view->layout   = $pageRow->layout;

        /** Set the layout path and layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH .'/'. $view->theme . '/layouts/scripts');
        Zend_Layout::getMvcInstance()->setLayout( $view->layout );

        /** Set the theme template vars (if any). */
        $this->_setThemeOptions($view, $pageRow );

        /** Set Page Title and Meta */
        $this->_setPageMeta( $view, $pageRow );

        /** Set OpenGraph View Params */
        $this->_setOpenGraph( $view, $pageRow );

        /** Set Scripts and Styles Params */
        $this->_setScriptsStyles( $view, $pageRow );

        /** Render the page Content */
        $view->content = $this->_renderPageContent( $pageRow, [ 'template' => $view->template ] );

    }

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

        if ( ! empty( $params['key'] ) ) {

            $key = $params['key'];

            $key = preg_replace( "/[^a-zA-Z0-9\-](html)/", '', $key );

            $pageModel = new Cms_Model_Page;
            return $pageModel->getPageContentByKey( $key );

        }
        else {
            return null;
        }

    }

    /**
     * Render the page content
     *
     * @param $pageRow
     * @param array $params
     * @return string
     * @throws Zend_View_Exception
     */
    protected function _renderPageContent ( $pageRow, $params ) {

        # This is a workaround because ZendFramework can only render FILES
        # and not strings. So, we write the string to a temp file, render
        # the file and then delete the temp file. Not the best solution but
        # it works within the framework's modus operandi.

        $filename = Tiger_Utility_Uuid::v4() . '.phtml';
        file_put_contents( sys_get_temp_dir() . '/' . $filename, $pageRow->content );
        $view = new Zend_View();
        $view->setScriptPath( sys_get_temp_dir() );
        $view->assign( $params );
        $content = $view->render( $filename );
        unlink( sys_get_temp_dir() . '/' . $filename );

        return $content;

    }

    /**
     * Set Page Meta
     *
     * @param $view
     * @param $pageRow
     */
    protected function _setPageMeta ( & $view, $pageRow ) {

        $view->headTitle()->set( $pageRow->meta_title );
        $view->headMeta( 'description', $pageRow->meta_description );

        // $view->headMeta('viewport', $this->seo_viewport );
        // $view->headMeta('keywords', $this->seo_keywords );
        // $view->headMeta('robots', $this->seo_robots );

        // $view->headMeta('Content-Type', 'text/html; charset=UTF-8');
        // $view->headMeta('Content-Language', LOCALE);

    }

    /**
     * Set OpenGraph Head Meta
     *
     * @param $view
     * @param $pageRow
     * @return null
     */
    protected function _setOpenGraph ( & $view, $pageRow ) {

        # Set OpenGraph Page Vars #
        // $view->headMeta()->setProperty('fb:app_id', $pageRow->fb_app_id);
        // $view->headMeta()->setProperty('og:site_name', $pageRow->og_sitename);

        $view->headMeta( 'og:title', $pageRow->og_title );
        $view->headMeta( 'og:description', $pageRow->og_description );
        $view->headMeta( 'og:og_url', $pageRow->og_type );
        $view->headMeta( 'og:type', $pageRow->og_title );
        $view->headMeta( 'og:locale', $pageRow->og_locale );

        $view->headMeta( 'og:image', $pageRow->og_image );
        $view->headMeta( 'og:image:secure_url', $pageRow->og_image );
        $view->headMeta( 'og:image:width', $pageRow->og_image_width );
        $view->headMeta( 'og:image:height', $pageRow->og_image_height );
        $view->headMeta( 'og:image:type', $pageRow->og_image_type );
        $view->headMeta( 'og:image:alt', $pageRow->og_image_alt );

        $view->headMeta( 'og:video', $pageRow->og_video );
        $view->headMeta( 'og:video:url', $pageRow->og_video );
        $view->headMeta( 'og:video:secure_url', $pageRow->og_video );
        $view->headMeta( 'og:video:width', $pageRow->og_video_width );
        $view->headMeta( 'og:video:height', $pageRow->og_video_height );
        $view->headMeta( 'og:video:type', $pageRow->og_video_type );

    }

    /**
     * Set Script and Style links, and raw page scripts and styles.
     *
     * @param $view
     * @param $pageRow
     * @return null
     */
    protected function _setScriptsStyles ( & $view, $pageRow ) {

        # Set any additional Stylesheet files. #
        $stylesheets = explode( PHP_EOL, $pageRow->css );
        foreach( $stylesheets as $stylesheet ) {
            $view->headLink()->appendStylesheet( $stylesheet );
        }

        # Set any additional Javascript files. #
        $javascripts = explode( PHP_EOL, $pageRow->javascript );
        foreach( $javascripts as $javascript ) {
            $view->inlineScript()->appendFile( Tiger_Cache::version( $javascript ) );
        }

        # Set any page-level CSS and JavaScripts. #
        if ( ! empty( $pageRow->styles ) ) {
            $view->headStyle()->appendStyle( $pageRow->styles );
        }
        if ( ! empty( $pageRow->scripts ) ) {
            $view->inlineScript()->appendScript( $pageRow->scripts );
        }

    }

}