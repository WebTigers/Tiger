<?php

class User_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name        = 'user';
    protected $_primary     = 'user_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    /**
     * @param $user_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getUserById ( $user_id )
    {
        $sql = $this->
            select()->
            where('user_id = ?', $user_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * @param null $identity
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getUserByIdentity( $identity )
    {
        /** This needs to join with the org table so that we make sure the org is active too. */

        $sql = $this->
            select()->
            from( [ 'ou' => 'org_user'], [] )->
            joinLeft( [ 'o' => 'org'], 'o.org_id = ou.org_id', ['o.*'] )->
            joinLeft( [ 'u' => 'user'], 'u.user_id = ou.user_id', ['u.*'] )->

            where('( u.user_id = ?', $identity)->
            orWhere('u.username = ?', $identity)->
            orWhere('u.email = ? )', $identity)->

            where('ou.active = 1')->
            where('ou.deleted = 0')->

            where('u.active = 1')->
            where('u.deleted = 0')->

            where('o.active = 1')->
            where('o.deleted = 0');

        return $this->fetchRow($sql);

    }

}
