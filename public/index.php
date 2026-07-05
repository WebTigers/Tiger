<?php
/**
 * Tiger app entry point. This file (and the docroot) is app-owned — yours forever.
 */

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'development');

define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));
define('VENDOR_PATH', realpath(__DIR__ . '/../vendor'));
define('TIGER_CORE_PATH', VENDOR_PATH . '/webtigers/tiger-core');

// Composer autoloads Zend_* (tigerzf), Tiger_* (tiger-core), and App_*/App\ (this app).
require VENDOR_PATH . '/autoload.php';

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()->run();
