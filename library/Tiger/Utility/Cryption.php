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

class Tiger_Utility_Cryption {

    const ENCRYPT = 'encrypt';
    const DECRYPT = 'decrypt';

    public static function encrypt( $string )
    {
        return self::encrypt_decrypt( $string, self::ENCRYPT );
    }

    public static function decrypt( $string )
    {
        return self::encrypt_decrypt( $string, self::DECRYPT );
    }

    private function encrypt_decrypt( $string, $action )
    {
        $encrypt_method = Zend_Registry::get('Zend_Config')->encryption->method;
        $hash_algo      = Zend_Registry::get('Zend_Config')->encryption->hash_algo;
        $secret_key     = Zend_Registry::get('Zend_Config')->encryption->key;
        $secret_iv      = Zend_Registry::get('Zend_Config')->encryption->iv;

        // get a hash of our secret key
        $key = hash( $hash_algo, $secret_key );

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr( hash( $hash_algo, $secret_iv ), 0, 16 );

        // $output will be a base_64 encoded string. Then we hex encode the output to give
        // us URL and DB safe ASCII for easy sharing of encrypted tokens.

        if ( $action === self::ENCRYPT ) {
            return bin2hex(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        }
        elseif ( $action === self::DECRYPT ) {
            return openssl_decrypt( hex2bin( $string ), $encrypt_method, $key, 0, $iv);
        }

    }

    public static function hash ( $string )
    {
        return hash( Zend_Registry::get('Zend_Config')->encryption->hash_algo, $string );
    }

}
