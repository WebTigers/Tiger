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

// Define path to public directory
defined('ASSETS_PATH')
    || define('ASSETS_PATH', realpath(dirname(__FILE__) . '/public/assets'));

// Define path to modules directory
defined('MODULES_PATH')
    || define('MODULES_PATH', realpath(dirname(__FILE__) . '/application/modules'));

// Define path to themes directory (same as modules)
defined('THEMES_PATH')
    || define('THEMES_PATH', realpath(dirname(__FILE__) . '/application/modules'));

// Define path to application directory
defined('CORE_MODULE_PATH')
    || define('CORE_MODULE_PATH', realpath(dirname(__FILE__) . '/application/modules/core'));

// Define path to vendor directory
defined('VENDOR_PATH')
    || define('VENDOR_PATH', realpath(dirname(__FILE__) . '/../tiger-vendor/vendor'));

// Define path to library directory
defined('CORE_LIBRARY_PATH')
    || define('CORE_LIBRARY_PATH', realpath(dirname(__FILE__) . '/application/modules/core/library'));

// Define path to library directory
defined('TIGER_CONFIG_PATH')
    || define('TIGER_CONFIG_PATH', realpath(dirname(__FILE__) . '/../tiger-config'));

// Define path to logs directory
defined('LOG_PATH')
    || define('LOG_PATH', realpath(dirname(__FILE__) . '/../tiger-logs'));

// Define path to the file upload directory
defined('UPLOAD_PATH')
    || define('UPLOAD_PATH', realpath(dirname(__FILE__) . '/upload'));

// Define path to the temporary file directory
defined('TMP_PATH')
    || define('TMP_PATH', realpath(dirname(__FILE__) . '/tmp'));

// Define path to the temporary file directory
defined('TEST_PATH')
    || define('TEST_PATH', realpath(dirname(__FILE__) . '/tests'));

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
