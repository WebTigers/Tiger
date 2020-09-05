<?php

class User_Model_OrgContact extends Zend_Db_Table_Abstract
{
    protected $_name        = 'org_contact';
    protected $_primary     = 'org_contact_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $org_contact_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgContactById ( $org_contact_id )
    {
        return $this->fetchRow( $this->select()->where( 'org_contact_id = ?', $org_contact_id ) );
    }

}
