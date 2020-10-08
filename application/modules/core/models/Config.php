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
 * Class Core_Model_Config
 */
class Core_Model_Config extends Zend_Db_Table_Abstract {
    
    protected $_name    = 'config';
    protected $_primary = 'config_id';
    protected $_rowClass = 'Tiger_Db_Table_Row';

    public function init ( ) {

    }

    public function getConfigById ( $config_id ) {
        
        $sql = $this->
                    select()->
                        where('config_id = ?', $config_id);
        
        return $this->fetchRow( $sql );
        
    }

    public function getAdminConfigSearchList ( $search = '', $offset = 0, $limit = 10, $orderby = '' ) {
        
        $sql = $this->
            select()->
                where  ( '( `key` LIKE ?', "%$search%" )->
                orWhere( '`value` LIKE ? )', "%$search%" )->
                order  ( $orderby )->
                limit  ( $limit, $offset );

        return $this->fetchAll( $sql );
        
    }

    public function getConfigs ( ) {

        $sql = $this->
                select()->
                    where('active = 1')->
                    where('deleted = 0');

        return $this->fetchAll( $sql );

    }

    public function getConfigArray ( ) {

        $configRowset = $this->getConfigs();

        // Concatenate the config rows into a string //

        $configStr = '';
        foreach ( $configRowset as $configRow ) {
            $configStr .= $configRow->key . ' = ' . $configRow->value . PHP_EOL;
        }

        return $this->_parse_ini_string_multi( $configStr );

    }

    protected function _parse_ini_string_multi ( $str, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL ) {

        $explode_str = '.';
        $escape_char = "'";

        // load ini string the normal way
        $data = parse_ini_string( $str, $process_sections, $scanner_mode );

        if ( ! $process_sections ) {
            $data = array( $data );
        }

        foreach ( $data as $section_key => $section ) {

            // loop inside the section
            foreach ( $section as $key => $value ) {

                if ( strpos( $key, $explode_str ) ) {

                    if (substr($key, 0, 1) !== $escape_char) {
                        // key has a dot. Explode on it, then parse each subkeys
                        // and set value at the right place thanks to references
                        $sub_keys = explode($explode_str, $key);
                        $subs =& $data[$section_key];
                        foreach ($sub_keys as $sub_key) {
                            if (!isset($subs[$sub_key])) {
                                $subs[$sub_key] = [];
                            }
                            $subs =& $subs[$sub_key];
                        }

                        // set the value at the right place
                        $subs = $value;

                        // unset the dotted key, we don't need it anymore
                        unset($data[$section_key][$key]);
                    }

                    // we have escaped the key, so we keep dots as they are
                    else {
                        $new_key = trim($key, $escape_char);
                        $data[$section_key][$new_key] = $value;
                        unset($data[$section_key][$key]);
                    }
                }
            }
        }

        if ( $process_sections === false ) {
            $data = $data[0];
        }

        return $data;

    }

}
