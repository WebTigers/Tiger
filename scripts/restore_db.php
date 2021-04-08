<?php

/**
 * Use this script if you want to restore a database from a backup file using the command line.
 *
 * Note the file will only be served from the tiger-backup directory at /var/www/tiger-backup/
 * You can restore the DB by calling the following from the commandline:
 *
 *     php /var/www/tiger-www/scripts/restore_db.php -f "YYYYMMDDHHMMSS.sql.gz" -u "username" -p "password"
 *
 * The Core DB Service will auto-authenticate if the user role is guest. Make sure you update the
 * cron jobs to use the proper user when authenticating backups. The backup DB service expects the
 * backup role to be "superadmin" and above.
 *
 * Note that the tiger user is used as the default. You should change this in production environments!
 */

// Get the filename, username, and password from the opts
$opts = getopt("f:u:p:");
$filename = $opts['f'];
$username = $opts['u'];
$password = $opts['p'];

// create & initialize a curl session
$curl = curl_init();

// set our url with curl_setopt()
curl_setopt($curl, CURLOPT_URL, "localhost/api/service/core:database/method/restore/filename/$filename/username/$username/password/$password");

// return the transfer as a string, also with setopt()
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// curl_exec() executes the started curl session
// $output contains the output string
$output = curl_exec($curl);

echo $output;

// close curl resource to free up system resources
// (deletes the variable made by curl_init)
curl_close($curl);
