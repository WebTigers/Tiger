<?php
/**
 * Tiger entry point. Keep it thin.
 *
 * All entry plumbing — proxy/ALB normalization, path constants, autoload + include paths, the
 * config cascade, and guarded dispatch — lives in Tiger_Application (in the tiger-core package).
 * App-level entry code goes in <root>/custom.php, never here.
 *
 * The one job here is finding the application root — the dir that holds vendor/ + application/.
 * Tiger auto-detects it so this same shim works whether the app sits BESIDE public/ (dev / VPS)
 * or ABOVE the docroot (cPanel / shared hosting, where the webroot is ~/public_html and the app
 * lives in a sibling dir like ~/tiger). Resolution order:
 *   1. TIGER_ROOT env var                     — explicit host/installer override
 *   2. a .tiger-root file next to this shim    — installer-written path (a dotfile; .htaccess
 *      denies serving it, so it's never web-exposed)
 *   3. dirname(__DIR__)                        — co-located:  <root>/public/index.php
 *   4. dirname(__DIR__)/tiger                  — split:       ~/public_html/index.php + ~/tiger
 */
$root = null;
foreach ([
    getenv('TIGER_ROOT') ?: null,
    is_file(__DIR__ . '/.tiger-root') ? trim((string) file_get_contents(__DIR__ . '/.tiger-root')) : null,
    dirname(__DIR__),
    dirname(__DIR__) . '/tiger',
] as $candidate) {
    if ($candidate && is_file($candidate . '/vendor/autoload.php')) {
        $root = $candidate;
        break;
    }
}

if ($root === null) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    exit("Tiger: could not locate the application root (no vendor/autoload.php found).\n"
       . "Set the TIGER_ROOT env var, or drop a .tiger-root file (containing its path) next to index.php.\n");
}

define('APPLICATION_ROOT', $root);

require APPLICATION_ROOT . '/vendor/autoload.php';

(new Tiger_Application(APPLICATION_ROOT))->run();
