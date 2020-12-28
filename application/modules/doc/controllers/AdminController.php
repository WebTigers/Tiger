<?php

class Doc_AdminController extends Tiger_Controller_Admin
{
    public function init()
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        $this->view->headLink()->appendStylesheet(Tiger_Cache::version('/assets/doc/css/simplemde.min.css'));

        $this->view->inlineScript()->appendFile(Tiger_Cache::version('/assets/doc/js/simplemde.min.js'));
        $this->view->inlineScript()->appendFile(Tiger_Cache::version('/assets/doc/js/doc.admin.doc.js'));

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('DOCUMENTATION');

    }

    ##### Admin Actions #####

    public function indexAction()
    {
        $this->view->docForm = new Doc_Form_Doc();
    }

    public function viewAction()
    {
    }
    
    public function editAction()
    {
    }
}
