<?php

class Message_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('HEADING.MESSAGES');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('message');
    }

    public function messageAction ( )
    {
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/tiger/tigerIconSelect.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/message/css/message.css' ) );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/vendor/MomentJS/Moment.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerIconSelect.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/message/js/message.admin.js' ) );

        $this->view->messageForm = new Message_Form_Message();

    }

}

