<?php
/**
 * Tiger entry point. Keep it thin.
 *
 * All entry plumbing — proxy/ALB normalization, path constants, autoload +
 * include paths, the config cascade, and guarded dispatch — lives in
 * Tiger_Application (in the tiger-core package). App-level entry code goes in
 * ../custom.php, never here.
 */
define('APPLICATION_ROOT', dirname(__DIR__));

require APPLICATION_ROOT . '/vendor/autoload.php';

(new Tiger_Application(APPLICATION_ROOT))->run();
