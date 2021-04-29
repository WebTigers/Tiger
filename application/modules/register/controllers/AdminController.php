<?php

class Register_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('REGISTER_MODULE');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('register');
    }

    public function registerAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/register/js/register.admin.register.js' ) );
        $this->view->registerForm = new Register_Form_Register();
    }

}

