<?php

class Dev_Model_AclResources extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'dev_resource';
    protected $_primary     = 'resource_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';
    
    public function init ( ) {
        
    }

    /**
     * getResourceById
     * 
     * Gets a resource by the resource_id
     * 
     * @param uuid (string) $resource_id
     * @return object of resource (table row) 
     */
    public function getResourceById ( $resource_id ) {
        
        $sql = $this->
                    select()->
                        where('resource_id = ?', $resource_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * getResourceByName
     * 
     * Gets a resource by the resource_name
     * 
     * @param $resource_name
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getResourceByName ( $resource_name ) {
        
        $sql = $this->
                    select()->
                        where('resource_name = ?', $resource_name);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getResourceList ( ) {
        
        $sql = $this->
            select()->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchAll( $sql );
        
    }

    public function getResourceDBConfigs ( ) {

        $resourceRowset = $this->getResourceList();
        $resources = [];
        foreach ( $resourceRowset as $resourceRow ) {
            $resources[ $resourceRow->resource_id ] = $resourceRow->toArray();
        }
        return new Zend_Config( $resources, true );

    }

    /**
     * Searches and returns a list of resources based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminResourceSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->select()->
            where( '( module_name LIKE ?', "%$search%" )->
            orWhere( 'resource_name LIKE ?', "%$search%" )->
            orWhere( 'resource_description LIKE ?', "%$search%" )->
            orWhere( 'resource LIKE ?', "%$search%" )->
            orWhere( 'privilege LIKE ? )', "%$search%" )->
            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
