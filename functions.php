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

/** Quick var print functions for debugging. */
function pr ($var, $die = true) {
    header("Content-Type:text/plain");
    if ($die) { die(print_r($var,1)); } else { print_r($var,1); }
}

/** Zend var print functions for debugging. */
function zd ($var, $die = true) {
    if ($die) { die(Zend_Debug::dump($var)); } else { Zend_Debug::dump($var); }
}

/** Function to test and return JSON data. */
function is_json( $string, $return_data = false ) {

    $data = json_decode($string);

    return ( json_last_error() === JSON_ERROR_NONE )
        ? ( $return_data )
            ? $data
            : true
        : false;
}

