<?php

class User_Model_UserContact extends Zend_Db_Table_Abstract
{
    protected $_name        = 'user_contact';
    protected $_primary     = 'user_contact_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init ( )
    {
    }

    /**
     * @param $user_contact_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgById ( $user_contact_id )
    {
        return $this->fetchRow( $this->select()->where( 'user_contact_id = ?', $user_contact_id ) );
    }

}
