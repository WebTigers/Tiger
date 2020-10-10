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

/** Include our App Constants */
require_once realpath(dirname(__FILE__) . '/../constants.php');

/** Include some Tiger Utility functions */
require_once realpath(dirname(__FILE__) . '/../functions.php');

/** Ensure library/ is on include_path */
set_include_path(implode(PATH_SEPARATOR, [
    VENDOR_PATH,
    CORE_LIBRARY_PATH,
    get_include_path(),
]));

/** Composer Autoload */
require_once VENDOR_PATH . '/autoload.php';

/** Zend_Application */
require_once 'Zend/Application.php';

/** Include early locale constant setting. Mostly this is for routing. */
require_once realpath(dirname(__FILE__) . '/../locale.php');

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    ['config' => [
        TIGER_CONFIG_PATH . '/tiger-restricted.ini',
        CORE_MODULE_PATH  . '/configs/application.ini',
        CORE_MODULE_PATH  . '/configs/constants.ini',
        CORE_MODULE_PATH  . '/configs/routes.ini',
        CORE_MODULE_PATH  . '/configs/navigation.ini',
    ]]
);

$application->bootstrap()->run();
