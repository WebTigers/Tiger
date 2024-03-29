<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

class Account_Model_Org extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'org';
    protected $_primary     = 'org_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    ### Account Functions ###

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

    public function getOrgByReferralCode ( $org_referral_code ) {

        $sql = $this->
            select()->
            where('org_referral_code = ?', $org_referral_code )->

            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchRow( $sql );

    }

    public function getOrgDefault ( ) {

        $sql = $this->
        select()->
        where('type_org = ?', 'DEFAULT')->
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

        $sql = $this->select();

        if ( is_array( $search ) ) {
            $sql->where('org_id IN ( ? )', $search );
        }
        else {
            $sql->where('( org_id LIKE ?', "%$search%")->
                orWhere( 'orgname LIKE ?', "%$search%" )->
                orWhere( 'org_display_name LIKE ?', "%$search%" )->
                orWhere( 'company_name LIKE ?', "%$search%" )->
                orWhere( 'org_description LIKE ?', "%$search%" )->
                orWhere( 'domain LIKE ?', "%$search%" )->
                orWhere( 'org_referral_code LIKE ?', "%$search%" )->
                orWhere( 'type_org LIKE ?', "%$search%" )->
                orWhere( 'type_hearabout LIKE ?', "%$search%" )->
                orWhere( 'type_business LIKE ? )', "%$search%" );
        }

        $sql->where( 'active = 1' )->
            where( 'deleted = 0' )->

        order( $orderby)->
        limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

    /**
     * Get Org User gets a user's current primary org
     * @param string $user_id
     * @param string $org_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getPrimaryOrgByUser ( string $user_id, string $org_id )
    {
        $sql = $this->
        select()->
        setIntegrityCheck( false )->

        from( [ 'ou' => 'org_user' ], ['ou.type_user_role'] )->
        joinLeft( array( 'o' => 'org' ), 'o.org_id  = ou.org_id', ['o.*'] )->

        where( 'ou.user_id = ?', $user_id )->
        where( 'o.org_id = ?', $org_id )->

        where( 'ou.primary = 1' )->
        where( 'o.active = 1' )->
        where( 'o.deleted = 0' );

        return $this->fetchRow( $sql );

    }

    ### Admin Only Functions ###

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
            orWhere( 'org_referral_code LIKE ?', "%$search%" )->
            orWhere( 'type_org LIKE ?', "%$search%" )->
            orWhere( 'type_hearabout LIKE ?', "%$search%" )->
            orWhere( 'type_business LIKE ? )', "%$search%" )->

            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
