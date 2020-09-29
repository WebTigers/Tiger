<?php

class Account_Model_Address extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'address';
    protected $_primary     = 'address_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init ( ) {
        
    }

    public function getAddressById ( $address_id )
    {
        $sql = $this->
            select()->
            where('address_id = ?', $address_id);

        return $this->fetchRow( $sql );

    }

}
