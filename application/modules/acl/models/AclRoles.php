<?php

class Acl_Model_AclRoles extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'acl_role';
    protected $_primary     = 'role_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init ( ) {
        
    }

    /**
     * getRoleById
     * 
     * Gets a role by the role_id
     * 
     * @param uuid (string) $role_id
     * @return object of role (table row) 
     */
    public function getRoleById ( $role_id ) {
        
        $sql = $this->
                    select()->
                        where('role_id = ?', $role_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * getRoleByName
     * 
     * Gets a role by the role_name
     * 
     * @param uuid (string) $role_name
     * @return object of role (table row) 
     */
    public function getRoleByName ( $role_name ) {
        
        $sql = $this->
                    select()->
                        where('role_name = ?', $role_name);
        
        return $this->fetchRow( $sql );
        
    }
    
    /**
     * Returns an array list of acl_roles 
     * 
     * @return Zend Rowset of acl_roles
     */
    public function getRoleList ( ) {
        
        $sql = $this->
                    select()->
                        where( 'active = 1' )->
                        where( 'deleted = 0' )->
                        order( 'priority ASC' );
        
        return $this->fetchAll( $sql );
        
    }

    public function getRoleDBConfigs ( ) {

        $roleRowset = $this->getRoleList();
        $roles = [];
        foreach ( $roleRowset as $roleRow ) {
            $roles[ $roleRow->role_id ] = $roleRow->toArray();
        }
        return new Zend_Config( $roles, true );

    }
    
    /**
     * Searches and returns a list of roles based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminRoleSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->select()->
            where( '( priority LIKE ?', "%$search%" )->
            orWhere( 'role_name LIKE ?', "%$search%" )->
            orWhere( 'parent_role_name LIKE ?', "%$search%" )->
            orWhere( 'role_description LIKE ? )', "%$search%" )->
            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
