<?php

class Translate_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('TRANSLATIONS');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard', 'admin', 'core');
    }

    public function translationAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/translate/js/translate.admin.translation.js' ) );
        $this->view->translationForm = new Translate_Form_Translation();
    }

}

