<?php

class Account_Model_User extends Zend_Db_Table_Abstract
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
     * @param $key
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getUserByEmailVerifyKey ( $key )
    {
        $sql = $this->
            select()->
            where('email_verify_key = ?', $key);

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
            setIntegrityCheck(false)->  // We need this for any kind of join where updates cannot be performed.
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

    /**
     * Searches and returns a list of users based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getUserSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' )
    {

        $sql = $this->select()->

            where( '( user_id LIKE ?', "%$search%" )->
            orWhere( 'username LIKE ?', "%$search%" )->
            orWhere( 'email LIKE ?', "%$search%" )->
            orWhere( 'user_display_name LIKE ?', "%$search%" )->
            orWhere( 'first_name LIKE ?', "%$search%" )->
            orWhere( 'middle_name LIKE ?', "%$search%" )->
            orWhere( 'last_name LIKE ?', "%$search%" )->
            orWhere( 'role LIKE ? )', "%$search%" )->

            where( 'active = 1' )->
            where( 'deleted = 0' )->

            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

    /**
     * Searches and returns a list of users based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminUserSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' )
    {

        $sql = $this->select()->

            where( '( user_id LIKE ?', "%$search%" )->
            orWhere( 'username LIKE ?', "%$search%" )->
            orWhere( 'email LIKE ?', "%$search%" )->
            orWhere( 'user_display_name LIKE ?', "%$search%" )->
            orWhere( 'first_name LIKE ?', "%$search%" )->
            orWhere( 'middle_name LIKE ?', "%$search%" )->
            orWhere( 'last_name LIKE ?', "%$search%" )->
            orWhere( 'role LIKE ? )', "%$search%" )->

            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
