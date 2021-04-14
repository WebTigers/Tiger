<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Module Language Translation Keys
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [

    // Generic Translations //
    'DT.ACTIVE' => 'Active',
    'DT.ACTIONS' => 'Actions',


    // Server Admin Translations //

    // PHP Info //
    'MENU.ADMIN.SERVER_PHPINFO' => 'PHP Info',

    // Cache //
    'HEADING.CACHE' => 'Cache',
    'TITLE.CACHE_CONTROLS' => 'Cache Controls',
    'MENU.ADMIN.SERVER_CACHE' => 'Cache',
    'MESSAGE.CACHE_CLEARED' => 'The cache has been cleared. Reload any page to refresh the cache.',
    'MESSAGE.CACHE_UPDATED' => 'Use Cache has been updated.',
    'LABEL.USE_CACHE' => 'Use Cache',
    'BUTTON.CLEAR_CACHE' => 'Clear Cache',
    'LABEL.CACHE_SERVERS' => 'Cache Servers',

    // Configs Translations //
    'TITLE.CONFIGURATION' => 'Configuration',
    'TITLE.STATIC_CONFIGURATION' => 'Static Configuration',

    // Backup //
    'MENU.ADMIN.SERVER_BACKUP' => 'Backup',
    'HEADING.BACKUP' => 'Backup',

    // Package //
    'MENU.ADMIN.PACKAGE' => 'Packages',
    'HEADING.PACKAGE' => 'Package Manager',

    'DT.PACKAGE_ID' => 'Package ID',
    'DT.PACKAGE_NAME' => 'Name',
    'DT.PACKAGE_TARGET_VERSION' => 'Target',
    'DT.PACKAGE_DESCRIPTION' => 'Description',
    'DT.PACKAGE_VERSION' => 'Version',
    'DT.PACKAGE_LATEST' => 'Latest',
    'DT.PACKAGE_REPO_TYPE' => 'Repository Type',
    'DT.PACKAGE_REPO_URL' => 'Repository URL',

    'MESSAGE.CONFIRM_PACKAGE_SYNC' => 'Synchronize Composer Packages',
    'MESSAGE.CONFIRM_PACKAGE_SYNC_TEXT_1' => 'If you\'ve made any changes to Composer via the command line or by directly editing the composer.json file this process will sync Tiger\'s packages with the composer.json.',
    'MESSAGE.CONFIRM_PACKAGE_SYNC_TEXT_2' => 'This is a non-destructive process that will not change your files or configuration. It simply updates the package table with your current composer.json and what is active in your module directory.',
    'MESSAGE.CONFIRM_PACKAGE_SYNC_TEXT_3' => 'This process happens automagically each night. Note that this process can take up to a minute or so to complete depending on how many packages (modules, themes, etc.) you have installed.',

];
