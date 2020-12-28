<?php

class Cms_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/ckeditor/contents.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/cms/css/cms.css' ) );

        /** OneUI Dashboard Bundles */
        # CKEditor's path autodetection does not like our Tiger_Cache busting. #
        $this->view->inlineScript()->appendFile( '/assets/oneui/js/plugins/ckeditor/ckeditor.js' );

        /** Global hero header vars. */
        $this->view->template->page_title = $this->view->translate('CMS_MODULE');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/cms/js/cms.admin.index.js' ) );
        $this->view->pageForm = new Cms_Form_Page();
    }

}

