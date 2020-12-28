<?php

class Media_ManageController extends Tiger_Controller_Manage
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
        $this->view->template->page_title = $this->view->translate('HEADER.MEDIA_GALLERY');

    }

    ##### Manage Actions #####

    public function indexAction ( )
    {
        $this->forward( 'gallery' );
    }

    public function galleryAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/media/js/media.manage.gallery.js' ) );
        $this->view->mediaForm = new Media_Form_Media();
    }

}

