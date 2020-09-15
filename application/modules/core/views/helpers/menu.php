<?php

class Core_View_Helper_Menu extends Zend_View_Helper_Abstract {

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

            // ACL allowed?

            /**
             * @TODO: There is a bug in this accept() if/then that if there is a hasNext() but it is not authorized within the ACL
             * then it will not complete the '</li><'</ul>' tags. Neet to fix this eventually. Right now it has been fixed by simply
             * making sure the last element of the ADMIN menu is always going to be accepted.
             */

            if ($this->navigation()->accept($page)) {

                $params = array(
                    # 'page'       => '',     // This is workaround appending the empty param so the router outputs the /index action.
                    'action' => $page->get('action'),
                    'controller' => $page->get('controller'),
                    'module' => $page->get('module'),
                );

                $locale = Zend_Registry::get('Tiger_Url_Locale');
                $route = (!empty($locale))
                    ? 'localized_' . $page->get('route')
                    : $page->get('route');

                // if ( $page->get('controller') === 'admin' ) { pr($page);  }

                // $url = $router->assemble( $params, $route, true );

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

        // pr( $menu );

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