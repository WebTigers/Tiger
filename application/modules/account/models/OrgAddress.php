<?php

class Account_Model_OrgAddress extends Zend_Db_Table_Abstract
{
    protected $_name        = 'org_address';
    protected $_primary     = 'org_address_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $org_address_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgAddressById ( $org_address_id )
    {
        return $this->fetchRow( $this->select()->where( 'org_address_id = ?', $org_address_id ) );
    }

}
