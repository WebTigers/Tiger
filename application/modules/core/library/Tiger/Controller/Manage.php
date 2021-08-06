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
 * Class Tiger_Controller_Manage
 *
 * This abstract class is designed to only be used by an Admin Controller. It allows us
 * to separate a lot of boilerplate code. Note that this class extends the Zend_Controller_Action
 * for any truly global inits or functions we may need for our application later.
 */
abstract class Tiger_Controller_Manage extends Zend_Controller_Action {

    public function init ( ) {
        
        parent::init();

        /** The Manage Controller is accessible on regular ports. If we get here from an admin high port, shift back to normal ports. */
        if ( in_array( $_SERVER['SERVER_PORT'], [ '8080', '8081' ] ) ) {
            $uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            $this->redirect( $uri );
        }

        /** Makes the Message View helpers available to all Admin Pages. */
        $this->view->addHelperPath(MODULES_PATH . '/message/views/helpers', 'Message_View_Helper');

        /** Set the base theme options. Note that this is what creates the $this->view->template var. */
        $contentService = new Core_Service_Content();
        $contentService->setPageContent( $this->view );

        $this->loadCommonAdminAssets();

        /** Set User to the theme container. */
        $this->view->template->user = Zend_Auth::getInstance()->getIdentity();

        /** This makes use of the default manage branch of the menu tree. */
        $this->view->template->menu = 'manage';

    }
    
    /**
     * 
     */
    public function preDispatch ( ) {
        
        parent::preDispatch();

        /** Allows us to do stuff within the predispatch phase. */

    }

    /**
     * 
     */
    public function postDispatch ( ) {
        
        parent::postDispatch();

        /** Allows us to do stuff within the postdispatch phase. */


    }

    /**
     * Load Common Admin Assets
     *
     * We put these in their own function in case we need them to be
     * called in some other was; and it keeps the init() cleaner.
     */
    protected function loadCommonAdminAssets ( ) {

        /** Set any custom CSS files you might have. These can also be set statically in the layout. */
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/select2/css/select2.min.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/datatables/dataTables.bootstrap4.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/oneui/custom/tiger.css' ) );

        /** Dashboard Bundles */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/chart.js/Chart.bundle.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/pages/be_pages_dashboard.min.js' ) );

        /** Set any custom JS files you might have. These can also be set statically in the layout. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/select2/js/select2.full.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/datatables/dataTables.bootstrap4.min.js' ) );

        /** Tiger Core DOM Plugins */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerForm.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDashboard.js' ) );

    }

    /**
     * This stubbed out function is just to let you know that you can create functions that are globablly
     * available to your application just by creating controllers that extend this Tiger_Controller_Action.
     */
    public function globalSomething ( )
    {
        // $request            = $this->getRequest();
        // $frontController    = $this->getFrontController();
    }

}
