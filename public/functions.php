<?php

// Quick var print functions for debugging
function pr ($var, $die = true) {
    header("Content-Type:text/plain");
    if ($die) { die(print_r($var,1)); } else { print_r($var,1); }
}

function zd ($var, $die = true) {
    if ($die) { die(Zend_Debug::dump($var)); } else { Zend_Debug::dump($var); }
}

function is_json( $string, $return_data = false ) {

    $data = json_decode($string);

    return (json_last_error() === JSON_ERROR_NONE)
        ? ($return_data)
            ? $data
            : true
        : false;
}

