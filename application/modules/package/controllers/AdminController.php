<?php

class Package_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('HEADING.PACKAGE');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('package' );
    }

    public function packageAction ()
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/package/js/package.admin.package.js' ) );
        $this->view->packageForm = new Package_Form_Package();
    }

}

