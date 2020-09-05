<?php

class User_Model_OrgUser extends Zend_Db_Table_Abstract
{
    protected $_name        = 'org_user';
    protected $_primary     = 'org_user_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $org_user_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgUserById ( $org_user_id )
    {
        return $this->fetchRow( $this->select()->where('org_user_id = ?', $org_user_id) );
    }

}
