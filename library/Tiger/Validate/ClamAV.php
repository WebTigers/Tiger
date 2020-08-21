<?php

class Tiger_Validate_ClamAV extends Zend_Validate_Abstract {

    const MSG_INFECTED_FILE = "infectedFile";
    const MSG_UNREADABLE_FILE = "unreadableFile";

    private $clamd_sock = "/var/www/clamd.scan/clamd.sock";
    private $clamd_sock_len = 20000;
    
    protected $_messageTemplates = array(
        self::MSG_INFECTED_FILE => "File is infected with a virus.",
        self::MSG_UNREADABLE_FILE => "Cannot read file.",
    );

    // https://github.com/kissit/php-clamav-scan/blob/master/Clamav.php

    /**
     * 
     * @param string $value path to the tmp file being scanned
     * @return boolean
     */
    public function isValid( $value = null ) {

        // $value = '/home/ec2-user/eicar_com.zip';

        // Scan a file
        $result = $this->_scan( $value );

        return $result;
    }

    /**
     * Private function to open a connection to the Clamd socket.
     * 
     * @return boolean
     */
    private function _socket() {

        try {

            if ( ! file_exists( $this->clamd_sock ) ){
                throw new Exception( 'File "' . $this->clamd_sock . '" does not exist.' );
            }

            if ( ! is_readable( $this->clamd_sock ) ){
                throw new Exception( 'File "' . $this->clamd_sock . '" is not Apache readable.' );
            }

            $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

            if (socket_connect($socket, $this->clamd_sock)) {
                return $socket;
            }

        }
        catch ( Exception $e ) {

            Tiger_Log::db('ClamAV ERROR', $e->getMessage(), Zend_Log::ERR);

        }

        return false;

    }

    /**
     * Ping the socket to make sure it's open.
     * 
     * @return boolean
     */
    public function ping() {
        
        $ping = $this->_send("PING");
        
        if ($ping == "PONG") {
            return true;
        }
        
        return false;
        
    }

    /**
     * Function to scan the passed in file. Returns true if safe, false otherwise.
     * 
     * @param type $file
     * @return boolean
     */
    private function _scan( $file ) {
        
        if ( file_exists( $file ) ) {
            
            $response = $this->_send("SCAN $file");
            $result = explode(":", $response);
            
            if ( isset( $result[1] ) && strtolower( trim($result[1] ) ) === "ok") {
                Tiger_Log::db('ClamAV Scan OK', $file, Zend_Log::INFO);
                return true;
            }

        }

        Tiger_Log::db('ClamAV Scan VIRUS FOUND', $file, Zend_Log::WARN);
        return false;
        
    }

    /**
     * Function to send a command to the Clamd socket. In case you need to send any other commands directly.
     * 
     * @param type $command
     * @return boolean
     */
    private function _send($command) {
        
        if (!empty($command)) {
            
            $socket = $this->_socket();
            
            if ($socket) {
                socket_send($socket, $command, strlen($command), 0);
                socket_recv($socket, $return, $this->clamd_sock_len, 0);
                socket_close($socket);
                return trim($return);
            }
            
        }
        
        return false;
        
    }

}
