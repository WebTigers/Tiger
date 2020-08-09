<?php

function getPasswordDescription_en_US () {

    $pw = Zend_Registry::get('Zend_Config')->password->toArray();

    // Build tooltip string ...

    $str  =     '<p><strong>Password Requirements:</strong></p>' .
        '<ul class="list icons list-unstyled">' .
        '<li><div class="progress">' .
        '<div id="progress-password-strength" class="progress-bar" role="progressbar" style="width: 0%; background-color: red;">' .
        '<span class="progress-bar-tooltip">0%</span>' .
        '</div></li>';

    if ( $pw['strength'] > 0 ){
        $str .=     '<li><i class="icon-password-strength fa fa-ban red"></i>Must have a Password Strength of at least: ' . $pw['strength'] . '</li>';
    }
    if ( $pw['length'] > 0 ){
        $plural = ($pw['length'] > 1 ) ? 'characters' : 'character';
        $str .=     '<li><i class="icon-password-length fa fa-ban red"></i>Should be minimum length of '. $pw['length'] . ' ' . $plural . '.</li>';
    }
    if ( $pw['lower'] > 0 ){
        $plural = ($pw['lower'] > 1 ) ? 'characters' : 'character';
        $str .=     '<li><i class="icon-password-lower fa fa-ban red"></i>Should contain at least '. $pw['lower'] . ' lowercase ' . $plural . '.</li>';
    }
    if ( $pw['upper'] > 0 ){
        $plural = ($pw['upper'] > 1 ) ? 'characters' : 'character';
        $str .=     '<li><i class="icon-password-upper fa fa-ban red"></i>Should contain at least '. $pw['upper'] . ' uppercase ' . $plural . '.</li>';
    }
    if ( $pw['digit'] > 0 ){
        $plural = ($pw['digit'] > 1 ) ? 'numbers' : 'number';
        $str .=     '<li><i class="icon-password-digit fa fa-ban red"></i>Should contain at least '. $pw['digit'] . ' ' . $plural . '.</li>';
    }
    if ( $pw['special'] > 0 ){
        $plural = ($pw['special'] > 1 ) ? 'characters' : 'character';
        $str .=     '<li><i class="icon-password-special fa fa-ban red"></i>Should contain at least '. $pw['special'] . ' punctuation ' . $plural . '.</li>';
    }
    if ( $pw['repeating'] > 1 ){
        $str .=     '<li><i class="icon-password-repeating fa fa-check green"></i>Cannot contain more than '. $pw['repeating'] . ' repeating characters.</li>';
    }
    $str     .=     '<li><i class="icon-password-illegal fa fa-check green"></i>Cannot contain any illegal characters.</li>';

    $str .=     '</ul>';

    return $str;
}

class Tiger_Controller_Plugin_Language extends Zend_Controller_Plugin_Abstract
{
    protected $_request;
    protected $_locale;
    protected $_translate;
    protected $_router;

    public function routeStartup(Zend_Controller_Request_Abstract $request) {
        $this->_request = $request;
        
        // pr( $request );

        $this->initLocale();
        $this->initTranslate();
        $this->initRouter();
        $this->initLocalizedRoutes();
    }

    public function routeShutdown(Zend_Controller_Request_Abstract $request) {
        // We have to wait for Zend's Router to cough up the module name, so
        // this is the first place the module name will be available within
        // the request object.

        // check for additional module translation files
        $module = strtolower($this->_request->getModuleName());

        if (($module !== 'default'))
        {
            $languageDirectory  = APPLICATION_PATH . '/modules/' . $module . '/languages';

            $translate = new Zend_Translate(
                            'array',
                            $languageDirectory,
                            $this->_locale,
                            array(
                                'scan' => Zend_Translate::LOCALE_DIRECTORY
                            )
            );

            // add the module translation to the base application translation array
            $this->_translate->addTranslation(array('content' => $translate));
        }
    }

    protected function initRouter() {
        $this->_router = Zend_Controller_Front::getInstance()->getRouter();
        Zend_Registry::set( 'Zend_Router', $this->_router );
    }

    protected function initLocale() {
        
        // First, attempt to discern if a locale exists within the first position of the uri string ...
        
        $uri_parts = explode('/', $_SERVER['REQUEST_URI']);
        $locale_part = ( isset( $uri_parts[1] ) ) ? $uri_parts[1] : null;
        $locale = ( Zend_Locale::isLocale( $locale_part ) )
                ? $locale_part
                : 'auto';

        // Second, if not locale URI string exists, check to see if we have a locale cookie set ...
        if ( $locale === 'auto' ) {
            $locale = (isset($_COOKIE['locale']) && Zend_Locale::isLocale($_COOKIE['locale']))
                ? $_COOKIE['locale']
                : 'auto';
        }

        // Finally, set our locale based on Zend's locale auto-detection and the request object's lang param.
        
        $this->_locale = new Zend_Locale( $locale );
        $this->_request->setParam('lang', $this->_locale->toString() );
        setcookie( 'locale', $this->_locale, time()+(360*24*365), '/' );

        // Stuff the locale into the registry for other locale-aware components
        Zend_Registry::set( 'Zend_Locale', $this->_locale );
        
    }

    protected function initTranslate() {

        $this->_translate = new Zend_Translate([
            'adapter' => 'Tiger_Translate_Adapter_Db',
            'content' => 'Db',
            'locale'  => $this->_locale,
        ]);

        // $this->_translate = new Zend_Translate(
        //      'array',
        //      APPLICATION_PATH . '/languages',
        //      $this->_locale,
        //      array(
        //          'scan' => Zend_Translate::LOCALE_DIRECTORY
        //      )
        // );

        // Check to see if we actually have a translation available for the locale.
        // If not, default to the en_US locale.
        
        if ( ! $this->_translate->isAvailable( $this->_locale->toString() ) ) {
            $this->_locale = new Zend_Locale('en_US');
            $this->_translate->getAdapter()->setLocale( $this->_locale );
            Zend_Registry::set( 'Zend_Locale', $this->_locale );
        }

        // now stuff translate into the registry for translate-aware components to find.
        Zend_Registry::set('Zend_Translate', $this->_translate);
    }

    protected function initLocalizedRoutes() {
        new Tiger_Router_Routes( $this->_locale, $this->_translate, $this->_router );
    }

}
