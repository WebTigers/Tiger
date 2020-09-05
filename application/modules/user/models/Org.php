<?php

class User_Model_Org extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'org';
    protected $_primary     = 'org_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $org_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgById ( $org_id )
    {
        return $this->fetchRow( $this->select()->where('org_id = ?', $org_id) );
    }

}
