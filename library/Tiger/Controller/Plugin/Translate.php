<?php

class Tiger_Controller_Plugin_Translate extends Zend_Controller_Plugin_Abstract
{
    public function routeStartup(Zend_Controller_Request_Abstract $request) {

        $locale = Zend_Registry::get('Zend_Locale');

        $translate = new Zend_Translate([
            'adapter' => 'Tiger_Translate_Adapter_Db',
            'content' => 'Db',
            'locale'  => $locale,
        ]);

        if ( ! $translate->isAvailable( $locale->toString() ) ) {
            $locale = new Zend_Locale('en_US');
            $translate->getAdapter()->setLocale( $locale );
            Zend_Registry::set( 'Zend_Locale', $locale );
        }

        Zend_Registry::set('Zend_Translate', $translate);

    }

}
