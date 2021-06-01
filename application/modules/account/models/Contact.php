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

class Account_Model_Contact extends Zend_Db_Table_Abstract
{
    protected $_name        = 'contact';
    protected $_primary     = 'contact_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    /**
     * @param $contact_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getContactById ( $contact_id )
    {
        return $this->fetchRow( $this->select()->where('contact_id = ?', $contact_id) );
    }

    /**
     * GetEntityContactById makes sure that the address we are getting belongs to the user who created it.
     *
     * @param $contact_id
     * @param $entity
     * @param $entity_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getEntityContactById ( $contact_id, $entity, $entity_id  ) {

        $joinTable = $entity . '_contact';  // $entity is either "org" or "user"

        $sql = $this->
        select()->
        setIntegrityCheck( false )->

        from( [ 'jt' => $joinTable ], [] )->
        joinLeft( array( 'c' => 'contact' ), 'c.contact_id  = jt.contact_id', ['c.*'] )->
        where( 'c.contact_id = ?', $contact_id )->
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
    public function getContactSearchList ( string $entity, string $entity_id, string $search, $offset = 0, $limit = 0, string $orderby )
    {
        $joinTable = $entity . '_contact';  // Either org_contact or user_contact

        $sql = $this->
            select()->
            setIntegrityCheck( false )->

            from( [ 'jt' => $joinTable ], [] )->
            joinLeft( array( 'c' => 'contact' ), 'c.contact_id  = jt.contact_id', ['c.*'] )->

            where( 'jt.' . $entity .'_id = ?', $entity_id )->
            where( '( c.contact_id LIKE ?', "%$search%" )->
            orWhere( 'c.contact_value LIKE ?', "%$search%" )->
            orWhere( 'c.type_contact LIKE ? )', "%$search%" )->
            where( 'c.active = 1' )->
            where( 'c.deleted = 0' )->

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
    public function getAdminContactSearchList ( string $entity, string $entity_id, string $search, $offset = 0, $limit = 0, string $orderby )
    {
        $joinTable = $entity . '_contact';  // Either org_contact or user_contact

        $sql = $this->
            select()->
            setIntegrityCheck( false )->

            from( [ 'jt' => $joinTable ], [] )->
            joinLeft( array( 'c' => 'contact' ), 'c.contact_id  = jt.contact_id', ['c.*'] )->

            where( 'jt.' . $entity .'_id = ?', $entity_id )->
            where( '( c.contact_id LIKE ?', "%$search%" )->
            orWhere( 'c.contact_value LIKE ?', "%$search%" )->
            orWhere( 'c.type_contact LIKE ? )', "%$search%" )->
            order( $orderby )->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
