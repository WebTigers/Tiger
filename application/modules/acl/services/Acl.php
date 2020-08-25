<?php

class Acl_Service_Acl extends Zend_Acl {

    const ROLE_GUEST = "guest";

    public function __construct() {

        $resourceModel  = new Acl_Model_AclResources;
        $roleModel      = new Acl_Model_AclRoles;
        $ruleModel      = new Acl_Model_AclRules;

        $resources      = $resourceModel->getResourceList();
        $roles          = $roleModel->getRoleList();
        $rules          = $ruleModel->getRuleList();

        $this->_addResources( $resources );
        $this->_addRoles( $roles );
        $this->_addRules( $rules );
        
        Zend_Registry::set( 'Zend_Acl', $this );
        
    }

    /**
     * A simple override that allows us to pass in an array of roles
     * via a comma delimited string.
     * 
     * @param mixed $aclRoles, an array of roles or a comma-delimited string of roles
     * @param type $resource
     * @param type $privilege
     * @return boolean
     */
    public function isAllowed( $aclRoles = null, $resource = null, $privilege = null ) {
        
        if ( ! is_array( $aclRoles ) ) {
            $roles = explode(',', $aclRoles);
        }
        
        foreach ( $roles as $role ) {
            if ( parent::isAllowed( $role, $resource, $privilege ) ) {
                return true;
            }
        }

        return false;
        
    }

    /**
     * Add all active roles to the ACL instance
     * 
     * @return void
     */
    protected function _addRoles ( $roles ) {

        foreach ( $roles as $role ) {
            
            if ( ! $this->hasRole( $role->role_name ) ) {
                
                if ( empty( $role->parent_role_name ) ) {
                    
                    $parents = null;
                    
                } else {
                    
                    $parents = explode(',', $role->parent_role_name);
                    
                }
                
                $this->addRole( new Zend_Acl_Role( $role->role_name ), $parents );
                
            }
            
        }
        
    }

    /**
     * Add all active resources to the ACL instance
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

                $this->addResource( new Zend_Acl_Resource( $resource->resource ), $parents );
                
            }

        }
        
    }    
    
    
    /**
     * Add all rules to the ACL
     * 
     * @return void 
     */
    protected function _addRules ( $rules ) {
        
        foreach ( $rules as $rule ) {

            $privilege = ( empty( $rule->privilege ) || $rule->privilege === 'all' ) ? null : $rule->privilege;
            
            if ( empty( $rule->assertion ) ) { 
                
                $assertion = null; 
                
            } else { 
                
                // Assertions should be in the form of Tiger_Acl_Assert_Someassertion
                
                $assert = $rule->assertion; 
                $assertion = new $assert();
                
            }

            if ( $rule->permission === 'allow' ) {
                $this->allow( 
                        $this->getRole( $rule->role ), 
                        $this->get( $rule->resource ), 
                        $privilege, 
                        $assertion 
                    );
            }

            if ( $rule->permission === 'deny' ) {
                $this->deny( 
                        $this->getRole( $rule->role ), 
                        $this->get( $rule->resource ), 
                        $privilege, 
                        $assertion 
                    );
            }
            
            // Get super granular with our rules if we like! And super confusing! Oy.
            
            if ( $rule->permission === 'removeDeny' ) {
                $this->removeDeny( 
                        $this->getRole( $rule->role ), 
                        $this->get( $rule->resource ), 
                        $privilege 
                    );
            }
            
            if ( $rule->permission === 'removeAllow' ) {
                $this->removeAllow( 
                        $this->getRole( $rule->role ), 
                        $this->get( $rule->resource ), 
                        $privilege 
                    );
            }
            
        }
            
    }

}
