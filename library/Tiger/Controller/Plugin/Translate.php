<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

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
