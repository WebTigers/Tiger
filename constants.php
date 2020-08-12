<?php

// AWS load balancing forwards the IP using X-headers
$_SERVER['REMOTE_ADDR'] = ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
    ? $_SERVER['HTTP_X_FORWARDED_FOR']
    : $_SERVER['REMOTE_ADDR'];

$https = ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' )
    ? true
    : ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' );

defined('HTTPS')
    || define('HTTPS', $https);

// Define path to public directory
defined('PUBLIC_PATH')
    || define('PUBLIC_PATH', realpath(dirname(__FILE__) . '/public'));

// Define path to modules directory
defined('MODULES_PATH')
    || define('MODULES_PATH', realpath(dirname(__FILE__) . '/application/modules'));

// Define path to application directory
defined('DEFAULT_MODULE_PATH')
    || define('DEFAULT_MODULE_PATH', realpath(dirname(__FILE__) . '/application/modules/default'));

// Define path to vendor directory
defined('VENDOR_PATH')
    || define('VENDOR_PATH', realpath(dirname(__FILE__) . '/../tiger-vendor/vendor'));

// Define path to library directory
defined('LIBRARY_PATH')
    || define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/library'));

// Define path to library directory
defined('TIGER_CONFIG_PATH')
    || define('TIGER_CONFIG_PATH', realpath(dirname(__FILE__) . '/../tiger-config'));

// Define path to logs directory
defined('LOG_PATH')
    || define('LOG_PATH', realpath(dirname(__FILE__) . '/tiger-logs'));

// Define path to the file upload directory
defined('UPLOAD_PATH')
    || define('UPLOAD_PATH', realpath(dirname(__FILE__) . '/upload'));

// Define path to the temporary file directory
defined('TMP_PATH')
    || define('TMP_PATH', realpath(dirname(__FILE__) . '/tmp'));

// Define path to the temporary file directory
defined('TEST_PATH')
    || define('TEST_PATH', realpath(dirname(__FILE__) . '/tests'));

// Define default locale
defined('DEFAULT_LOCALE')
    || define('DEFAULT_LOCALE', 'en_US');

defined('TIGER_ID')
    || define('TIGER_ID', '00000000-0000-0000-0000-000000000000');

// Define application environment
$env = 'production';
if (getenv('APPLICATION_ENV')){
    $env = getenv('APPLICATION_ENV');
}

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', $env);

// Define maintenance mode
$maint = false;
if (getenv('APPLICATION_MAINT')){
    $maint = ( getenv('APPLICATION_MAINT') === 'true' ) ? true  : false;
}

defined('APPLICATION_MAINT')
    || define('APPLICATION_MAINT', $maint);
