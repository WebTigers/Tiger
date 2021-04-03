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
 * Class Docy_View_Helper_Menu
 */
class Docy_View_Helper_Menu extends Zend_View_Helper_Abstract {

    public function __construct ( ) {

        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl(Zend_Registry::get('Zend_Acl'));
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole(Zend_Auth::getInstance()->getIdentity()->role);

    }

    public function render()
    {
        // var_dump( Zend_Auth::getInstance()->getIdentity()->role );

        $translate = Zend_Registry::get('Zend_Translate');
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $view = Zend_Layout::getMvcInstance()->getView();
        $iterator = new RecursiveIteratorIterator(new RecursiveCachingIterator($this->container), RecursiveIteratorIterator::SELF_FIRST);

        $menu = '<ul class="nav nav-pills nav-main" id="mainMenu" data-role="' . Zend_Auth::getInstance()->getIdentity()->role . '">';

        foreach ($iterator as $page) {

            /** ACL allowed? */

            if ( $this->navigation()->accept($page) ) {

                $params = array(
                    'action' => $page->get('action'),
                    'controller' => $page->get('controller'),
                    'module' => $page->get('module'),
                );

                $locale = Zend_Registry::get('Tiger_Url_Locale');

                $route = ( ! empty($locale) )
                    ? 'localized_' . $page->get('route')
                    : $page->get('route');

                $appendIndex = ($page->action === 'index') ? '/index' : '';
                $url = $page->getHref() . $appendIndex;

                // Sub menu item

                // Check if the page has children and then setup classes and html inserts

                $liChildClass = ($page->hasChildren())
                    ? ($page->get('class') === 'submenu')
                        ? 'dropdown-submenu'
                        : 'dropdown'
                    : $page->get('class');

                $aChildClass = ($page->hasChildren())
                    ? 'dropdown-toggle'
                    : '';

                $iChildClass = ($page->hasChildren() && $page->get('class') !== 'submenu')
                    ? ' <i class="fa fa-angle-down"></i>'
                    : '';

                $menu .= '<li class="' . $liChildClass . '">'
                    . '<a class="' . $aChildClass . '" href="' . $url . '">' . $translate->_($page->label) . $iChildClass . '</a>';

                if ($page->hasChildren()) {
                    $menu .= '<ul class="dropdown-menu">';
                } else {
                    $menu .= '</li>';
                }

                if (!$page->hasChildren() && !$iterator->hasNext()) {
                    // Close sub menu - last child
                    $menu .= '</ul></li>';
                }

            }

        }

        // If we are logged in, show different partials

        if (Zend_Auth::getInstance()->getIdentity()->role !== 'guest') {

            $menu .= $this->partial('loggedin.phtml', array(
                'login_form' => $view->login_form
            ));

        } else {

            $menu .= $this->partial('signin.phtml');

        }

        $menu .= '</ul>';

        echo $menu;
    }
}