<?php

class Acl_Model_AclRules extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'acl_rule';
    protected $_primary     = 'rule_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init ( ) {
        
    }

    /**
     * getRuleById
     * 
     * Gets a rule by the rule_id
     * 
     * @param uuid (string) $rule_id
     * @return object of rule (table row) 
     */
    public function getRuleById ( $rule_id ) {
        
        $sql = $this->
                    select()->
                        where('rule_id = ?', $rule_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * getRuleByName
     * 
     * Gets a rule by the rule_name
     * 
     * @param uuid (string) $rule_name
     * @return object of rule (table row) 
     */
    public function getRuleByName ( $rule_name ) {
        
        $sql = $this->
                    select()->
                        where('rule_name = ?', $rule_name);
        
        return $this->fetchRow( $sql );
        
    }
    
    /**
     * Returns an array list of acl_rules 
     * 
     * @return Zend Rowset of acl_rules
     */
    public function getRuleList ( ) {
        
        $sql = $this->
                    select()->
                        where( 'active = 1' )->
                        where( 'deleted = 0' )->
                        order( 'priority ASC' );
        
        return $this->fetchAll( $sql );
        
    }

    public function getRuleDBConfigs ( ) {

        $ruleRowset = $this->getRuleList();
        $rules = [];
        foreach ( $ruleRowset as $ruleRow ) {
            $rules[ $ruleRow->rule_id ] = $ruleRow->toArray();
        }
        return new Zend_Config( $rules, true );

    }

    /**
     * Searches and returns a list of rules based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminRuleSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->select()->
            where( '( priority LIKE ?', "%$search%" )->
            orWhere( 'rule_name LIKE ?', "%$search%" )->
            orWhere( 'rule_description LIKE ?', "%$search%" )->
            orWhere( 'permission LIKE ?', "%$search%" )->
            orWhere( 'resource LIKE ?', "%$search%" )->
            orWhere( 'privilege LIKE ?', "%$search%" )->
            orWhere( 'assertion LIKE ?', "%$search%" )->
            orWhere( 'role LIKE ? )', "%$search%" )->
            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
