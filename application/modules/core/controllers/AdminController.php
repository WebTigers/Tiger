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

class AdminController extends Tiger_Controller_Admin
{
    protected $_adminService;

    public function init()
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        $this->_adminService = new Core_Service_Admin([]);

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard');
    }

    public function dashboardAction ( )
    {
        $this->view->template->page_title = $this->view->translate('DASHBOARD');
        $this->_checkSetup();
    }

    public function configAction ( )
    {
        $this->view->template->page_title = $this->view->translate('HEADING.SERVER_CONFIGURATION');
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/core.admin.config.js' ) );
        $this->view->configForm = new Core_Form_Config();
    }

    public function phpinfoAction ( )
    {
        $this->view->template->page_title = $this->view->translate('HEADING.PHPINFO');
    }

    public function cacheAction ()
    {
        $this->view->template->page_title = $this->view->translate('HEADING.CACHE');
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/core.admin.cache.js' ) );
        $this->view->useCache = boolval( Zend_Registry::get('Zend_Config')->tiger->cache->useCache );
        $this->view->cacheServers = $this->_adminService->getCacheServerTextList();
    }

    public function backupAction ()
    {
        $this->view->template->page_title = $this->view->translate('HEADING.BACKUP');
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/core.admin.backup.js' ) );
    }

    private function _checkSetup(){

        /**
         * The rule to allow superadmin access to AdminSetup exists only in the database. Once setup is complete,
         * this rule is disabled and no one is allowed access to the AdminSetup service again unless you manually
         * re-enable this rule. This prevents the AdminSetup from being run more than once.
         */

        if ( Zend_Registry::get('Zend_Acl')->isAllowed( 'superadmin', 'Core_Service_AdminSetup', 'setup' ) ) {
            $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerFormWizard.js' ) );
            $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerPassword.js' ) );
            $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/core.admin.setup.js' ) );
            $this->view->setupForm = new Core_Form_Setup();
        }

    }

}

