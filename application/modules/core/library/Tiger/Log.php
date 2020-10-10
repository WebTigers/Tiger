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

class Tiger_Log {

    const ROLE_GUEST = "guest";

    /**
     * Tiger Log File
     * 
     * Logs the message within the /tiger-logs/application.log
     * 
     * @param string $string message
     * @param string $priority level
     * @param string $extras additional detail
     */
    public static function file ( $string, $priority = Zend_Log::NOTICE, $extras = null ){
        
        $writer = new Zend_Log_Writer_Stream( LOG_PATH . '/application.log' );
        $logger = new Zend_Log( $writer );

        // Log the event
        $logger->log( $string, $priority, $extras );
    }

    /**
     * Tiger Log PHP Error
     *
     * Logs the message within the /tiger-logs/php-error.log
     *
     * @param string $string message
     * @param string $priority level
     * @param string $extras additional detail
     */
    public static function error ( $string, $priority = Zend_Log::ERR, $extras = null ){

        $writer = new Zend_Log_Writer_Stream( LOG_PATH . '/php-error.log' );
        $logger = new Zend_Log( $writer );

        // Log the event
        $logger->log( $string, $priority, $extras );
    }

    /**
     * Tiger Log DB
     * 
     * Logs the message within the log_application table.
     * 
     * @param string $string message
     * @param string $priority level
     * @param string $extras additional detail
     */
    public static function db ( 
            $source, 
            $message, 
            $priority = Zend_Log::NOTICE, 
            $extras = null ) {
        
        $db_adapter = Zend_Db_Table::getDefaultAdapter();
        
        $columnMapping = array(
            'log_application_id' => 'log_application_id',
            'source'             => 'source',
            'priority'           => 'priority', 
            'message'            => 'message', 
            'timestamp'          => 'timestamp', 
            'username'           => 'username',
            'tid'                => 'tid',
        );
        
        $writer = new Zend_Log_Writer_Db( $db_adapter, 'log_application', $columnMapping );
        $logger = new Zend_Log( $writer );
        
        $username = ( Zend_Auth::getInstance()->hasIdentity() ) 
            ? Zend_Auth::getInstance()->getIdentity()->username
            : self::ROLE_GUEST;
        
        $TID = ( isset( $_COOKIE['TID'] ) ) ? $_COOKIE['TID'] : 0;

        $datetimeObj = DateTime::createFromFormat('0.u00 U', microtime());
        $datetime = $datetimeObj->format('Y-m-d H:i:s.u');

        $logger->setEventItem( 'log_application_id', Tiger_Utility_Uuid::v4() );
        $logger->setEventItem( 'source',    $source );
        $logger->setEventItem( 'username',  $username );
        $logger->setEventItem( 'tid',       $TID );
        $logger->setEventItem( 'timestamp', $datetime );  // Note the additional microtime precision

        // Log the event
        $logger->log( $message, $priority, $extras );
        
    }

    /**
     * Tiger Log Trace
     * Provides a convenient trace to track down the last exception.
     * @return type
     */
    public static function trace() {
        
        $e = new Exception();
        $trace = explode("\n", $e->getTraceAsString());
        // reverse array to make steps line up chronologically
        $trace = array_reverse($trace);
        array_shift( $trace );            // remove {main}
        array_pop( $trace );              // remove call to this method
        $length = count( $trace );
        $result = array();

        // replace '#someNum' with '$i)', set the right ordering
        for ($i = 0; $i < $length; $i++) {
            $result[] = ($i + 1) . ')' . substr($trace[$i], strpos($trace[$i], ' ')); 
        }

        // return serialize( $result );
        
        return "\t" . implode("\n\t", $result);
    }

}
