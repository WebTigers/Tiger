<?php

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
