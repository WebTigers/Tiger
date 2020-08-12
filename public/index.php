<?php

/** Include our App Constants */
require_once realpath(dirname(__FILE__) . '/../constants.php');

/** Include some Tiger Utility functions */
require_once realpath(dirname(__FILE__) . '/../functions.php');

/** Ensure library/ is on include_path */
set_include_path(implode(PATH_SEPARATOR, [
    VENDOR_PATH,
    LIBRARY_PATH,
    get_include_path(),
]));

/** Composer Autoload */
require_once VENDOR_PATH . '/autoload.php';

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    ['config' => [
        TIGER_CONFIG_PATH . '/tiger-restricted.ini',
        CORE_MODULE_PATH . '/configs/application.ini',
    ]]
);

$application->bootstrap()->run();
