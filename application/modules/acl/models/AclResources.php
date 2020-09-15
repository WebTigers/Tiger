<?php

class Acl_Model_AclResources extends Zend_Db_Table_Abstract {
    
    protected $_name    = 'acl_resource';
    protected $_primary = 'resource_id';
    
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
     * @param uuid (string) $resource_name
     * @return object of resource (table row) 
     */
    public function getResourceByName ( $resource_name ) {
        
        $sql = $this->
                    select()->
                        where('resource_name = ?', $resource_name);
        
        return $this->fetchRow( $sql );
        
    }
    
    /**
     * Returns an array list of acl_resources 
     * 
     * @return Zend Rowset of acl_resources
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

}
