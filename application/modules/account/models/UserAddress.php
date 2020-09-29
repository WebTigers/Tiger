<?php

class Account_Model_UserAddress extends Zend_Db_Table_Abstract
{
    protected $_name        = 'user_address';
    protected $_primary     = 'user_address_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $user_address_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getUserAddressById ( $user_address_id )
    {
        return $this->fetchRow( $this->select()->where( 'user_address_id = ?', $user_address_id ) );
    }

}
