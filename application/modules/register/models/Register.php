<?php

class Register_Model_Register extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'register';
    protected $_primary     = 'register_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';
    
    public function init ( ) {
        
    }

    /**
     * getRegisterById
     * 
     * Gets a register by the register_id
     * 
     * @param uuid (string) $register_id
     * @return object of register (table row) 
     */
    public function getRegistrationById ( $register_id ) {
        
        $sql = $this->
                    select()->
                        where('register_id = ?', $register_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * Searches and returns a list of registers based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminRegistrationsSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->select()->
            where( '( first_name LIKE ?', "%$search%" )->
            orWhere( 'last_name LIKE ?', "%$search%" )->
            orWhere( 'email LIKE ?', "%$search%" )->
            orWhere( 'company_name LIKE ?', "%$search%" )->
            orWhere( 'country LIKE ? )', "%$search%" )->
            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
