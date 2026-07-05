<?php
/**
 * App entry hook (optional, app-owned).
 *
 * Loaded by Tiger_Application after constants + Composer autoload are ready, and
 * before the app boots. Put app-level entry code here so index.php stays thin
 * and you never edit Tiger's entry plumbing:
 *
 *   - app constants:   define('MY_FLAG', true);
 *   - helper functions: function my_helper() { ... }
 *   - pre-bootstrap tweaks (ini_set, custom autoloaders, etc.)
 *
 * Anything here survives `composer update` — it's yours.
 */
