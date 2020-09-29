<?php

class Account_Model_Org extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'org';
    protected $_primary     = 'org_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    ### Account Functions ###

    /**
     * getOrgByName
     *
     * Gets an org by the orgname
     *
     * @param $resource_name
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgByName ( $orgname ) {

        $sql = $this->
            select()->
            where('orgname = ?', $orgname)->

            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchRow( $sql );

    }

    /**
     * Get Org Search List
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getOrgSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
        select()->
        where( '( org_id LIKE ?', "%$search%" )->
        orWhere( 'orgname LIKE ?', "%$search%" )->
        orWhere( 'org_display_name LIKE ?', "%$search%" )->
        orWhere( 'company_name LIKE ?', "%$search%" )->
        orWhere( 'org_description LIKE ?', "%$search%" )->
        orWhere( 'domain LIKE ?', "%$search%" )->
        orWhere( 'referral_code LIKE ?', "%$search%" )->
        orWhere( 'type_org LIKE ?', "%$search%" )->
        orWhere( 'type_hearabout LIKE ?', "%$search%" )->
        orWhere( 'type_business LIKE ? )', "%$search%" )->

        where( 'active = 1' )->
        where( 'deleted = 0' )->

        order( $orderby)->
        limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

    ### Admin Only Functions ###

    /**
     * Get Org By Id
     *
     * @param $org_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgById ( $org_id )
    {
        $sql = $this->select()->where( 'org_id = ?', $org_id );
        return $this->fetchRow( $sql );
    }

    /**
     * Searches and returns a list of orgs based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminOrgSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' )
    {

        $sql = $this->select()->

            where( '( org_id LIKE ?', "%$search%" )->
            orWhere( 'orgname LIKE ?', "%$search%" )->
            orWhere( 'org_display_name LIKE ?', "%$search%" )->
            orWhere( 'company_name LIKE ?', "%$search%" )->
            orWhere( 'org_description LIKE ?', "%$search%" )->
            orWhere( 'domain LIKE ?', "%$search%" )->
            orWhere( 'referral_code LIKE ?', "%$search%" )->
            orWhere( 'type_org LIKE ?', "%$search%" )->
            orWhere( 'type_hearabout LIKE ?', "%$search%" )->
            orWhere( 'type_business LIKE ? )', "%$search%" )->

            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
