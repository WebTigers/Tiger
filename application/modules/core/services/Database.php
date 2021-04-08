<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

/**
 * Class Core_Service_Database
 *
 * The Core Database Service class is primarily used by the backup_db.php and the
 * restore_db.php scripts. See these files for notes on how to use them for CRON
 * database backup and auto-restore (for demo purposes).
 *
 */
class Core_Service_Database
{

    protected $_locale;
    protected $_config;
    protected $_response;
    protected $_request;
    protected $_form;
    protected $_reflection;

    public function __construct( $input ) {

        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_response    = new Core_Model_ResponseObject();

        if ( $input instanceof Zend_Controller_Request_Http ) {
            $this->_request = $input;
            $params = $this->_request->getParams();
        }
        elseif ( is_array($input) ) {
            $params = $input;
        }

        if ( ! isset( $this->_reflection ) ) {
            $this->_reflection = new ReflectionClass( $this );
        }

        if ( isset( $params['form'] ) && class_exists( $params['form'], true ) ) {
            $this->_form = new $params['form'];
        }

        $this->_dispatch( $params );

    }

    // Common Class Functions //

    /**
     * If this service is called via the API, the dispatch
     * method will route the $params to the proper function.
     * @param type $params
     */
    private function _dispatch ( $params ) {

        try {

            if ( isset( $params['method'] ) ) {

                // filter the method to just camelCase alphaNumeric for security
                $method = Zend_Filter::filterStatic( $params['method'],
                    'PregReplace', array('match' => '/[^A-Za-z0-9]/', 'replace' => '') );

                // make sure the method exists and that it's public
                if ( method_exists( $this, $method ) &&
                    $this->_reflection->getMethod( $method )->isPublic() ) {
                    $this->{$method}( $params );
                }
            }
        }

        catch ( Exception $e ) {

            // @TODO Need to log this

        }

    }

    /**
     * Gets the Core ResponseObject
     * @return object of ResponseObject
     */
    public function getResponse() {
        return $this->_response;
    }

    // Public Functions //

    public function restore ( $params ) {

        $dir = "/var/www/tiger-backup/";

        $filename = ( isset( $params['filename'] ) )
            ? $params['filename']
            : '';

        if ( ! is_file( $dir . $filename ) || ! is_readable( $dir . $filename ) ){
            throw new Exception('Backup file not found.');
        }

        $db = Zend_Registry::get('Zend_Config')->resources->db->params;

        $cmd = "gunzip < {$dir}{$filename} |  mysql -h {$db->host} -u {$db->username} --password={$db->password} {$db->dbname}";

        try {

            $output = [];
            exec( $cmd, $output );

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.RESTORE_COMPLETED', 'success');

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage('MESSAGE.RESTORE_ERROR', 'error');

        }

    }

    public function backup ( $params ) {

        $dir = "/var/www/tiger-backup/";

        $filename = ( ! empty( $params['filename'] ) )
            ? $params['filename'] . ".sql.gz"
            : "tiger-backup-" . date("YmdHis") . ".sql.gz";

        $db = Zend_Registry::get('Zend_Config')->resources->db->params;

        $cmd = "mysqldump -h {$db->host} -u {$db->username} --password={$db->password} {$db->dbname} | gzip > {$dir}{$filename}";

        try {

            $output = [];
            exec( $cmd, $output );

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.BACKUP_COMPLETED', 'success');

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage('MESSAGE.BACKUP_ERROR', 'error');

        }

    }

    /**
     * Purge old backup files.
     * Gets the days to keep old database backup files from the core module's application.ini.
     * Will not purge files that are not automated backups that do not begin with "tiger-backup-".
     *
     * @param $params
     * @throws Zend_Exception
     */
    public function purge ( $params ) {

        $path   = '/var/www/tiger-backup/';
        $files  = glob( $path . "tiger-backup-*");
        $now    = time();
        $days   = Zend_Registry::get('Zend_Config')->tiger->backup->days;

        try {

            foreach ( $files as $file ) {

                if ( is_file( $file ) ) {

                    if ( $now - filemtime( $file ) >= 60 * 60 * 24 * $days ) {

                        unlink($file);

                    }

                }

            }

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.OLD_BACKUPS_PURGED', 'success');

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error');

        }

    }

}