<?php

class Media_AdminController extends Tiger_Controller_Admin
{
    public function init ( )
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        parent::init();

        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/dropzone/dist/min/dropzone.min.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/vendor/prettyPhoto/css/prettyPhoto.css' ) );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/vendor/prettyPhoto/js/jquery.prettyPhoto.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/vendor/clipboardJS/dist/clipboard.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/dropzone/dropzone.min.js' ) );

        /** Global hero header vars */
        $this->view->template->page_title = $this->view->translate('MEDIA_ADMIN');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('gallery');
    }

    public function galleryAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/media/js/media.admin.gallery.js' ) );
        $this->view->mediaForm = new Media_Form_Media();
    }

    public function purgeAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/media/js/media.admin.purge.js' ) );
    }

}

