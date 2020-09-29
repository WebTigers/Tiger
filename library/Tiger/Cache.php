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

class Tiger_Cache {

    /**
     * Tiger Cache Busting
     * 
     * http://ajk.fi/2014/cache-busting/
     * 
     * @param array $array
     * @return type
     */
    public static function version ( $file ) {
        
        $file = str_replace('http://', '', $file);
        $file = str_replace('https://', '', $file);
        $file = str_replace($_SERVER['SERVER_NAME'], '', $file);
        
        $full_file = $_SERVER['DOCUMENT_ROOT'] . $file;
        
        if (strpos($file, '/') !== 0 || !file_exists($full_file)) {
            
            $full_file = substr($_SERVER['SCRIPT_FILENAME'], 0, -strlen($_SERVER['SCRIPT_NAME']));
            $full_file .= $file;
            
            if ( ! file_exists( $full_file ) ) {
                return $file;
            }
            
        }
        
        $mtime = filemtime( $full_file );
        $new_file = preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
        
        return $new_file;
        
    }
    
}
