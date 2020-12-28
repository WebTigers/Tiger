<?php

class Dev_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->one->page_title = $this->view->translate('DEV_MODULE');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard', 'admin', 'core');
    }

    public function resourceAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/dev/js/dev.admin.resource.js' ) );
        $this->view->resourceForm = new Dev_Form_Resource();
    }

}

