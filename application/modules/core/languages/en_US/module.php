<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Module Language Translation Keys
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [

    // Platform Name //
    'PLATFORM.NAME' => 'Tiger',

    // Admin //
    'ADMIN.DASHBOARD' => 'Admin Dashboard',

    // Manage //
    'MANAGE.DASHBOARD' => 'Dashboard',

    // Generic Translations //
    'DT.ACTIVE' => 'Active',
    'DT.ACTIONS' => 'Actions',
    'DT.EDIT' => 'Edit',


    // Server Admin Translations //

    // Boilerplate //
    'TITLE.SYSTEM' => 'System',
    'LABEL.CREATE_DATE' => 'Create Date',
    'LABEL.CREATED_BY' => 'Created By User',
    'LABEL.UPDATE_DATE' => 'Update Date',
    'LABEL.UPDATED_BY' => 'Updated By User',
    'TITLE.SETTINGS' => 'Settings',
    'LABEL.ACTIVE' => 'Active',
    'DESCRIPTION.ACTIVE' => 'Sets the record as either active or inactive. Inactive records are generally not seen and can be reactivated.',
    'LABEL.DELETED' => 'Deleted',
    'DESCRIPTION.DELETED' => 'Sets the record as deleted. Records set with the deleted flag enabled are considered deleted data and not shown.',
    'DT.ACTIVE_INACTIVE' => 'Toggle Active or Inactive',
    'DT.DELETE_UNDELETE' => 'Toggle Delete or Undelete',

    // PHP Info //
    'MENU.ADMIN.SERVER_PHPINFO' => 'PHP Info',
    'HEADING.PHPINFO' => 'PHP Information',

    // Cache //
    'HEADING.CACHE' => 'Cache',
    'TITLE.CACHE_CONTROLS' => 'Cache Controls',
    'MENU.ADMIN.SERVER_CACHE' => 'Cache',
    'MESSAGE.CACHE_CLEARED' => 'The cache has been cleared. Reload any page to refresh the cache.',
    'MESSAGE.CACHE_UPDATED' => 'Use Cache has been updated.',
    'LABEL.USE_CACHE' => 'Use Cache',
    'DESCRIPTION.USE_CACHE' => 'Leave this setting off unless you really need the performance boost due to latency of non-cached resources.',
    'BUTTON.CLEAR_CACHE' => 'Clear Cache',
    'DESCRIPTION.CLEAR_CACHE' => 'If you are using caching, this will clear the cache forcing Memcached to rebuild the cache on the next request.',
    'LABEL.CACHE_SERVERS' => 'Cache Servers',
    'DESCRIPTION.CACHE_SERVERS' => 'List the IP addresses of your Memcached servers here.',

    // Configs Translations //
    'TITLE.CONFIGURATION' => 'Configuration',
    'TITLE.CONFIG' => 'Configuration',
    'TITLE.STATIC_CONFIGURATION' => 'Static Configuration',
    'FORM.EDIT_CONFIG' => 'Edit a Configuration Param',
    'FORM.ADD_CONFIG' => 'Add a Configuration Param',
    'TAB.CONFIG' => 'Config',
    'LABEL.KEY' => 'Config Key',
    'DESCRIPTION.KEY' => 'The configuration key in dot.notation that represents a property within the configuration array.',
    'LABEL.VALUE' => 'Config Value',
    'DESCRIPTION.VALUE' => 'The configuration value that represents a value being set within the configuration array.',
    'DT.ACTIVE_INACTIVE_CONFIG' => 'Toggle active or inactive configuration param.',
    'DT.DELETE_UNDELETE_CONFIG' => 'Toggle delete or undelete configuration param.',
    'DT.EDIT_CONFIG' => 'Edit this configuration param.',

    // Backup //
    'MENU.ADMIN.SERVER_BACKUP' => 'Backup',
    'HEADING.BACKUP' => 'Backup',
    'TITLE.BACKUP_CONTROLS' => 'Backup Controls',

    'DT.FILENAME' => 'Filename',
    'DT.FILESIZE' => 'Filesize',
    'DT.FILEDATE' => 'File Date',
    'DT.FILEPATH' => 'File Path',
    'DT.RESTORE_DB' => 'Restore Database from File',
    'DT.DELETE_FILE' => 'Delete Database Backup File',
    'FORM.ADD_BACKUP' => 'Create New Database Backup',
    'LABEL.OPTIONAL_FILE_NAME' => 'File Name (Optional)',
    'DESCRIPTION.OPTIONAL_FILE_NAME' => 'Enter an optional filename. The file will be saved as your filename with the &quot;.sql.gz&quot; file type appended.',
    'BUTTON.BACKUP_NOW' => 'Backup Now',

    'MESSAGE.BACKUP_COMPLETED' => 'Backup Completed Successfully.',
    'MESSAGE.BACKUP_REMOVE_SUCCESS' => 'Backup file successfully removed.',
    'MESSAGE.BACKUP_REMOVE_ERROR' => 'There was an error removing the backup file.',

];
