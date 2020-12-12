<?php

class Dev_Service_Acl extends Zend_Acl {

    protected $_resourceModel;

    const ROLE_GUEST = "guest";

    public function __construct() {

        $this->_resourceModel   = new Dev_Model_AclResources;

    }

    /**
     * Add all active resources to the DEV instance
     * 
     * @return void 
     */
    protected function _addResources ( $resources ) {

        foreach ( $resources as $resource ) {

            if ( ! $this->has( $resource->resource ) ) {

                if ( empty( $resource->parents ) ) {
                    
                    $parents = null;
                    
                } else {
                    
                    $parents = explode(',', $resource->parents);
                    
                }

                $this->addResource( new Zend_Dev_Resource( $resource->resource ), $parents );
                
            }

        }
        
    }    

    /**
     * @return Zend_Config
     */
    protected function _getAppResourceList ( )
    {
        $resourceConfigs = Zend_Registry::get('Zend_Config')->dev->resources;
        $resourceDBConfigs = $this->_resourceModel->getResourceDBConfigs();
        if ( ! empty( $resourceConfigs ) ) {
            $resourceDBConfigs->merge( $resourceConfigs );
        }
        return $resourceDBConfigs;
    }

}
