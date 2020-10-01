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

class Core_Model_USZipCode extends Zend_Db_Table_Abstract
{
    protected $_name    = 'county_zip_code';
    protected $_primary = 'zip_code';
    
    public function init()
    {
        parent::init();
        
    }

    public function getUSZipCodeByZipCode ( $zip_code ) {
        
        $sql = $this->
                select()->
                    where( 'zip_code = ?', $zip_code );
        
        return $this->fetchRow( $sql );
        
    }

    public function getUSZipCodeByCityState ( $city, $state ) {

        $sql = $this->
                select()->
                    where( 'city  = ?', $city )->
                    where( 'state = ?', $state );

        return $this->fetchRow( $sql );

    }

    /**
     * @param $search
     * @return array
     */
    public function getUSZipCodeSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
            select()->
                from( $this, [
                    'id' => 'zip_code',
                    'name' => 'zip_code',
                    'lat',
                    'lng',
                    'city',
                    'state',
                    'zip_code'
                ])->
                where('(zip_code LIKE ?', "%$search%")->
                orWhere('city LIKE ?', "%$search%")->
                orWhere('county LIKE ?', "%$search%")->
                orWhere('state LIKE ?)', "%$search%")->
                order( $orderby )->
                limit( $limit, $offset );

        return $this->fetchAll($sql)->toArray();

    }

    
}
