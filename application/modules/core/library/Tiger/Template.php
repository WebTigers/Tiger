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

class Tiger_Template {

    /**
     * Get
     *
     * Pulls a template from the database and renders it with PHP variables.
     *
     * @param string $key
     * @param array $params
     * @return mixed
     */
    public static function get( $key = null, $params = [] ) {

        $pageModel = new Cms_Model_Page();
        $pageRow = $pageModel->getPageByKey( $key );
        return self::render( $pageRow->content, $params );

    }

    /**
     * Render the template content
     *
     * @param $content
     * @param array $params
     * @return string
     * @throws Zend_View_Exception
     */
    public static function render( $content, $params = [] ) {

        /**
         * This is a workaround because ZendFramework can only render FILES
         * and not strings. So, we write the string to a temp file, render
         * the file and then delete the temp file. Not the best solution but
         * it works within the framework's modus operandi.
         */

        $filename = Tiger_Utility_Uuid::v4() . '.phtml';
        file_put_contents( sys_get_temp_dir() . '/' . $filename, $content );

        $view = new Zend_View();

        $view->setScriptPath( sys_get_temp_dir() );

        $view->addHelperPath(MODULES_PATH . '/cms/views/helpers/', 'Cms_View_Helper');

        $view->assign( $params );
        $content = $view->render( $filename );

        unlink( sys_get_temp_dir() . '/' . $filename );

        return $content;

    }
    
}
