<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Module Language Translation Keys
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [
    'MENU.ADMIN.PACKAGES' => 'ADMIN PACKAGES',
    'MENU.ADMIN.PACKAGE' => 'Package Manager',
    'HEADING.PACKAGE' => 'Package Manager',

    'DT.PACKAGE_ID' => 'Package ID',
    'DT.PACKAGE_NAME' => 'Name',
    'DT.PACKAGE_TARGET_VERSION' => 'Target',
    'DT.PACKAGE_DESCRIPTION' => 'Description',
    'DT.PACKAGE_VERSION' => 'Version',
    'DT.PACKAGE_LATEST' => 'Latest',
    'DT.PACKAGE_REPO_TYPE' => 'Repository Type',
    'DT.PACKAGE_REPO_URL' => 'Repository URL',

    'DT.UPDATE_PACKAGE' => 'Update',
    'DT.EDIT_PACKAGE' => 'Edit',
    'DT.ACTIVE_INACTIVE_PACKAGE' => 'Activate / Deactivate',
    'DT.DELETE_PACKAGE' => 'Delete',

    'FORM.ADD_PACKAGE' => 'Add Package',
    'FORM.EDIT_PACKAGE' => 'Edit Package',
    'FORM.CANCEL' => 'Cancel',
    'FORM.CONFIRM' => 'Confirm',
    'TAB.PACKAGE' => 'Package',
    'TITLE.PACKAGE' => 'Package',
    'LABEL.PACKAGE_NAME' => 'Package Name',
    'DESCRIPTION.PACKAGE_NAME' => 'Enter the name of the package you would like to add to Tiger. Typical names are domain/package, like: aws/aws-sdk-php',
    'LABEL.TARGET_VERSION' => 'Target Version',
    'DESCRIPTION.TARGET_VERSION' => 'Enter the target version of the package using standard Composer version notation.',
    'LABEL.REPO_TYPE' => 'Repository Type',
    'DESCRIPTION.REPO_TYPE' => 'Enter the type of repository where the package is hosted. Typical repo types are: vcs, composer, package, etc.',
    'LABEL.REPO_URL' => 'Repository URL',
    'DESCRIPTION.REPO_URL' => 'If necessary. enter the URL if the repository where the package is hosted. Packages hosted with Packagist do not need a URL. Typical URL\'s are like: git@github.com:WebTigers/canvas.git',

    'MESSAGE.CONFIRM_PACKAGE_SYNC' => 'Synchronize Composer Packages',
    'MESSAGE.CONFIRM_PACKAGE_SYNC_TEXT_1' => 'If you\'ve made any changes to Composer via the command line or by directly editing the composer.json file this process will sync Tiger\'s packages with the composer.json.',
    'MESSAGE.CONFIRM_PACKAGE_SYNC_TEXT_2' => 'This is a non-destructive process that will not change your files or configuration. It simply updates the package table with your current composer.json and what is active in your module directory.',
    'MESSAGE.CONFIRM_PACKAGE_SYNC_TEXT_3' => 'This process happens automagically each night. Note that this process can take up to a minute or so to complete depending on how many packages (modules, themes, etc.) you have installed.',

    'FORM.SAVE_PACKAGE' => 'Save Package',
    'MESSAGE.SYNC_PACKAGES_COMPLETED' => 'Packages Sync Completed',
    'MESSAGE.PACKAGE_UPDATED' => 'Package Updated',

    'WARNING.TOKEN_NOT_SET' => 'NOTICE: The Tiger Auth Token Is Missing',
    'WARNING.TOKEN_NOT_SET_TEXT' => 'The token that authorizes your instance to access Tiger updates has not yet been set. See Tiger\'s Package Module docs for instructions to set this token before using the Package Manager.'

];
