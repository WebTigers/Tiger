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

class Account_Model_Address extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'address';
    protected $_primary     = 'address_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    /**
     * @param $address_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getAddressById ( $address_id )
    {
        $sql = $this->
            select()->
            where('address_id = ?', $address_id);

        return $this->fetchRow( $sql );

    }

    /**
     * GetEntityAddressById makes sure that the address we are getting belongs to the user who created it.
     *
     * @param $address_id
     * @param $entity
     * @param $entity_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getEntityAddressById ( $address_id, $entity, $entity_id  ) {

        $joinTable = $entity . '_address';  // $entity is either "org" or "user"

        $sql = $this->
        select()->
        setIntegrityCheck( false )->

        from( [ 'jt' => $joinTable ], [] )->
        joinLeft( array( 'a' => 'address' ), 'a.address_id  = jt.address_id', ['a.*'] )->
        where( 'a.address_id = ?', $address_id )->
        where( 'jt.' . $entity .'_id = ?', $entity_id );

        return $this->fetchRow( $sql );

    }

    /**
     * Searches and returns a list of users based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $entity
     * @param string $entity_id
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @param string $orderby
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAddressSearchList ( string $entity, string $entity_id, string $search, $offset = 0, $limit = 0, string $orderby )
    {
        $joinTable = $entity . '_address';  // $entity is either "org" or "user"

        $sql = $this->
        select()->
        setIntegrityCheck( false )->

        from( [ 'jt' => $joinTable ], [] )->
        joinLeft( array( 'a' => 'address' ), 'a.address_id  = jt.address_id', ['a.*'] )->

        where( 'jt.' . $entity .'_id = ?', $entity_id )->
        where( '( a.address_id LIKE ?', "%$search%" )->
        orWhere( 'a.address LIKE ?', "%$search%" )->
        orWhere( 'a.address2 LIKE ?', "%$search%" )->
        orWhere( 'a.city LIKE ?', "%$search%" )->
        orWhere( 'a.county LIKE ?', "%$search%" )->
        orWhere( 'a.state LIKE ?', "%$search%" )->
        orWhere( 'a.postal_code LIKE ?', "%$search%" )->
        orWhere( 'a.country LIKE ?', "%$search%" )->
        orWhere( 'a.type_address LIKE ? )', "%$search%" )->
        where( ' a.active = 1' )->
        where( ' a.deleted = 0' )->
        order( $orderby )->
        limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

    /**
     * Searches and returns a list of users based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $entity
     * @param string $entity_id
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @param string $orderby
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAdminAddressSearchList ( string $entity, string $entity_id, string $search, $offset = 0, $limit = 0, string $orderby )
    {
        $joinTable = $entity . '_address';  // $entity is either "org" or "user"

        $sql = $this->
        select()->
        setIntegrityCheck( false )->

        from( [ 'jt' => $joinTable ], [] )->
        joinLeft( array( 'a' => 'address' ), 'a.address_id  = jt.address_id', ['a.*'] )->

        where( 'jt.' . $entity .'_id = ?', $entity_id )->
        where( '( a.address_id LIKE ?', "%$search%" )->
        orWhere( 'a.address LIKE ?', "%$search%" )->
        orWhere( 'a.address2 LIKE ?', "%$search%" )->
        orWhere( 'a.city LIKE ?', "%$search%" )->
        orWhere( 'a.county LIKE ?', "%$search%" )->
        orWhere( 'a.state LIKE ?', "%$search%" )->
        orWhere( 'a.postal_code LIKE ?', "%$search%" )->
        orWhere( 'a.country LIKE ?', "%$search%" )->
        orWhere( 'a.type_address LIKE ? )', "%$search%" )->
        order( $orderby )->
        limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
