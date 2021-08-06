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

/**
 * Class Core_Service_Utility is designed to be a light-weight utility class that
 * contains a collection of common functions shared by all of the various services.
 */
class Core_Service_Utility
{

    public function validateDataTables ( Array $post ) {

        $regexValidator = new Zend_Validate_Regex( array('pattern' => '/^[A-Za-z0-9 \'\.\_\-,]+$/') );
        $intValidator   = new Zend_Validate_Int();

        $out = [];

        if ( ! empty($post['search']['value']) && ! $regexValidator->isValid( $post['search']['value'] ) ) {
            foreach ( $regexValidator->getMessages() as $messageId => $message ) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['start'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['length'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        return ( empty($out) ) ? true : $out;

    }

    public function getTypeSelect2List ( $params )
    {
        $typeModel = new Core_Model_Type();

        $params['key'] = ( ! empty( $params['key'] ) ) ? $params['key'] : null;

        $results = [];
        $typeRowset = $typeModel->getTypeListByReference( $params['reference'], $params['key'] );

        foreach ( $typeRowset as $typeRow ) {
            $results[] = (object) ['id' => $typeRow->key, 'text' => $typeRow->type_name ];
        }

        return new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getTranslation ( $keys ) {

        if ( empty( $keys ) ) { return $keys; }

        if ( is_string( $keys ) ) {
            return Zend_Registry::get('Zend_Translate')->translate( $keys );
        }

        $out = [];
        foreach( $keys as $key ) {
            $out[ $key ] = Zend_Registry::get('Zend_Translate')->translate( $key );
        }

        return $out;

    }

    public function getMediaFolderByAllowedMimeType ( $mimeTypes, $type )
    {
        $out = 'other';
        foreach ( $mimeTypes as $folder => $types ) {
            if ( in_array($type, $types->toArray() ) ) {
                $out = $folder;
                break;
            }
        }
        return $out;
    }

    public function getLocalSelect2List ( $params )
    {
        $locales = Zend_Registry::get('Zend_Translate')->getList();

        $out = [];
        foreach ( $locales as $key => $locale ) {
            $out[] = (object) [ 'id' => $locale, 'text' => $locale . ' | '. Zend_Locale::getTranslationList('language', LOCALE )[ $locale ] ];
        }
        return $out;
    }

    public static function getTimeAgo ( $datetime ) {

        $time = strtotime( $datetime );

        $translate = Zend_Registry::get('Zend_Translate');

        $time_difference = time() - $time;

        if ( $time_difference < 11 ) {
            return 'Just now';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  $translate->translate('UTILITY.YEAR'),
            30 * 24 * 60 * 60       =>  $translate->translate('UTILITY.MONTH'),
            24 * 60 * 60            =>  $translate->translate('UTILITY.DAY'),
            60 * 60                 =>  $translate->translate('UTILITY.HOUR'),
            60                      =>  $translate->translate('UTILITY.MINUTE'),
            1                       =>  $translate->translate('UTILITY.SECOND')
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if ( $d >= 1 ) {
                $t = round( $d );
                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ' . $translate->translate('UTILITY.AGO');
            }

        }

    }


}