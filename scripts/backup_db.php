<?php

/**
 * A simple cURL script to call Tiger and run the backup DB service from the command line.
 *
 * Note the file will only be served from the tiger-backup directory at /var/www/tiger-backup/
 * You can make a manual backup by calling the following from the commandline with the -f param
 * and a filename, like:
 *
 *     php /var/www/tiger-www/scripts/backup_db.php -f "demo.sql.gz" -u "username" -p "password"
 *
 * If you do not specify a filename, then the backup will simply have a datetime filename.
 *
 * The Core DB Service will auto-authenticate if the user role is guest. Make sure you update the
 * cron jobs to use the proper user when authenticating backups. The backup DB service expects the
 * backup role to be "superadmin" and above.
 *
 * Note that the tiger user is used as the default. You should change this in production environments!
 *
 */

// Get the filename, username, and password from the opts
$opts = getopt("f::u:p:");
$filename = ( isset( $opts['f'] ) ) ? $opts['f'] : '';
$username = $opts['u'];
$password = $opts['p'];

// create & initialize a curl session
$curl = curl_init();

// set our url with curl_setopt()
curl_setopt($curl, CURLOPT_URL, "localhost/api/service/core:database/method/backup/filename/$filename/username/$username/password/$password");

// return the transfer as a string, also with setopt()
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// curl_exec() executes the started curl session
// $output contains the output string
$output = curl_exec($curl);

echo $output . "\n";

// close curl resource to free up system resources
// (deletes the variable made by curl_init)
curl_close($curl);
