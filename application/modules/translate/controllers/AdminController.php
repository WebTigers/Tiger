<?php

class Translate_AdminController extends Tiger_Controller_Action
{
    public function init ( )
    {
        /** The Admin Controller and Admin Service are only available on ports 8080 and 8081 for security purposes. */
        if ( ! in_array( $_SERVER['SERVER_PORT'], [ '8080', '8081' ] ) ) {
            throw new Error( 'ADMIN.DISALLOWED' );
        }

        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        /** Set the OneUI base theme options. */
        $contentService = new Core_Service_Content();
        $contentService->setPageContent( $this->view );

        /** Set any custom CSS files you might have. These can also be set statically in the layout. */
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/select2/css/select2.min.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/datatables/dataTables.bootstrap4.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/oneui/custom/tiger.css' ) );

        /** OneUI Dashboard Bundles */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.core.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.app.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/chart.js/Chart.bundle.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/pages/be_pages_dashboard.min.js' ) );

        /** Set any custom JS files you might have. These can also be set statically in the layout. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/select2/js/select2.full.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/datatables/dataTables.bootstrap4.min.js' ) );

        /** Tiger Core DOM Plugins */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerForm.js' ) );

        /** Set User to the theme container */
        $this->view->template->user = Zend_Auth::getInstance()->getIdentity();

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

