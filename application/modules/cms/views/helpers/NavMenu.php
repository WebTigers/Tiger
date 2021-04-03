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
 * Class Cms_View_Helper_Menu
 *
 * This CMS view helper simply accepts the name of a theme and navigation name, then
 * uses a theme's view partial to render the menu using the theme's partial.
 */
class Cms_View_Helper_NavMenu extends Zend_View_Helper_Abstract {

    public $view;

    public function setView ( Zend_View_Interface $view ) {
        $this->view = $view;
    }

    public function navMenu( $navName ) {

        try {
            $menu = $this->view->navigation()->findById( $navName );
            return $this->view->navigation()->menu()->renderPartial( $menu, ['menu.phtml', 'canvas'] );
        }
        catch ( Exception | Error $e ){

            pr( $e->getMessage() );

        }

    }

}