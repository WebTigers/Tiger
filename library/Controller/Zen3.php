<?php

class Tiger_Controller_Zen3 extends Tiger_Controller_Auth {
    
    public function init() {
        
        parent::init();
        
        // TEMPORARY: Clear any headlinks and headscripts for now until the new theme goes live
        # $this->view->headLink()->setStylesheet( null );
        # $this->view->headScript()->setScript( null );
        
        
        // Set the new Zen3 theme by setting different layout and view paths
        $this->_helper->layout->setLayoutPath( APPLICATION_PATH . '/themes/zen3/layouts/scripts/' );
        $this->view->setBasePath( APPLICATION_PATH . '/themes/zen3/views/' );
        
        // Google Web Fonts
        $this->view->headLink()->appendStylesheet( '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light' );

        
        // Vendor and Theme CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/vendor/bootstrap/bootstrap.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/vendor/fontawesome/css/font-awesome.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/vendor/owlcarousel/owl.carousel.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/vendor/owlcarousel/owl.theme.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/vendor/magnific-popup/magnific-popup.css' ) );

        // Theme CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/theme.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/theme-blog.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/theme-shop.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/theme-elements.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/theme-animate.css' ) );
        
        
        // Admin Extension Specific Page Vendor CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/select2-3.4.8/select2.css' ) );
        // $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/select2-4.1.0/dist/css/select2.css' ) );
        // $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/select2-4.1.0/dist/css/select2-bootstrap.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/pnotify/pnotify.custom.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/vendor/bootstrap-switch/css/bootstrap-switch.min.css' ) );

        // Admin Extension CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/stylesheets/theme-admin-extension.css' ) );
        
        //Admin Extension Skin CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/themes/zen3/admin/assets/stylesheets/skins/extension.css' ) );
        
        // Skin CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/skins/default.css' ) );
        
        // Theme Custom CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/css/custom.css' ) );
        
        // Admin Extension Custom CSS
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version( '/themes/zen3/admin/assets/stylesheets/theme-custom.css' ) );
        
        // Vendor Head Scripts (within the Head of the document)
        $this->view->headScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/modernizr/modernizr.js' ) );
        
        
        // Vendor Inline Scripts (at the bottom of the document)
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/jquery/jquery.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.autofill.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/jquery.appear/jquery.appear.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/jquery.easing/jquery.easing.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/jquery-cookie/jquery-cookie.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/bootstrap/bootstrap.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/common/common.js' ) );
        
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/bootstrap/tooltip.js' ) );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/moment.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/twitter/typeahead.bundle.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/handlebars/handlebars.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/isotope/jquery.imagesLoaded.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/isotope/jquery.isotope.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/select2-3.4.8/select2.js' ) );
        // $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/admin/assets/vendor/select2-4.1.0/dist/js/select2.full.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/bootstrap-switch/js/bootstrap-switch.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/clipboard.js/dist/clipboard.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js' ) );

        // Theme Base, Components and Settings
        // $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/js/theme.js' ) );
        
        // Admin Extension Specific Page Vendor
        // $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/admin/assets/javascripts/theme.admin.extension.js' ) );

        // Theme Initialization Files
        // $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/js/theme.init.js' ) );
        
        // Theme Customizations
        // $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/js/custom.js' ) );
        
        // Tiger JS
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.tigerForm.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.tigerLocalize.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.newList.SessionExpire.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.newList.Subscriber.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/themes/zen3/default/jquery.newList.Signin.js' ) );

        // Google reCaptcha
        $this->view->inlineScript()->appendFile( 'https://www.google.com/recaptcha/api.js?onload=reCaptchaOnload&render=explicit', null, ['defer'=>'','async'=>'']);
        
    }
    
}
