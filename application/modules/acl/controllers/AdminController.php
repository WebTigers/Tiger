<?php

class Acl_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('PERMISSIONS');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard', 'admin', 'core');
    }

    public function resourceAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/acl/js/acl.admin.resource.js' ) );
        $this->view->resourceForm = new Acl_Form_Resource();
    }

    public function roleAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/acl/js/acl.admin.role.js' ) );
        $this->view->roleForm = new Acl_Form_Role();
    }

    public function ruleAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/acl/js/acl.admin.rule.js' ) );
        $this->view->ruleForm = new Acl_Form_Rule();
    }

}

