<?php

class Manual_IndexController extends Tiger_Controller_Action
{
    public function init ( )
    {
        parent::init();

        $this->view->doctype( Zend_View_Helper_Doctype::HTML5 );    // <-- need this for headMeta()->setProperty() to work.
        $this->view->headMeta()->setCharset('UTF-8');
        $this->view->headMeta()->setProperty('viewport', 'width=device-width, initial-scale=1, shrink-to-fit=no');
        $this->view->headTitle()->set( 'Zend Framework 1 Manual' );

        $this->view->headLink()->appendStylesheet( 'https://fonts.googleapis.com/css?family=Lato:100,300,400,400i,500,700,900,' );
        $this->view->headLink()->appendStylesheet( 'https://fonts.googleapis.com/css?family=Raleway:100,300,400,400i,500,700,900,' );
        $this->view->headLink()->appendStylesheet( 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css' );
        $this->view->headLink()->appendStylesheet( 'https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.7.2/build/styles/default.min.css' );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/manual/css/manual.css') ); // <-- Tiger_Cache prevents browser caching

        $this->view->inlineScript()->appendFile( 'https://code.jquery.com/jquery-3.5.1.min.js' );
        $this->view->inlineScript()->appendFile( 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js' );
        $this->view->inlineScript()->appendFile( 'https://kit.fontawesome.com/8514e8187e.js' );
        $this->view->inlineScript()->appendFile( 'https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.7.2/build/highlight.min.js' );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version('/assets/manual/js/manual.js') );

        $this->view->addHelperPath(MODULES_PATH . '/manual/views/helpers', 'Manual_View_Helper');

    }

    ##### Admin Actions #####

    public function indexAction ( )
    {

    }

}

