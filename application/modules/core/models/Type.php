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

class Core_Model_Type extends Zend_Db_Table_Abstract
{
    protected $_name        = 'type';
    protected $_primary     = 'type_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    protected $_translate;

    public function init ( ) {

        $this->_translate = Zend_Registry::get( 'Zend_Translate' );

    }

    public function getTypeById ( $type_id ) {

        $sql = $this->select()->
            where('type_id = ?', $type_id );
        
        return $this->fetchRow( $sql );

    }

    /**
     * @param string $reference
     * @param string $key
     * @param false $formatForSelect
     * @param string $locale
     * @return array | Zend_Db_Table_Rowset_Abstract
     */
    public function getTypeListByReference ( string $reference, string $key = null, $formatForSelect = false ) {

        $sql = $this->select()->
        where( 'reference = ?', $reference)->
        where( 'active = ?', 1 )->
        where( 'deleted = ?', 0 )->
        order( 'sort_order' );

        if ( ! empty( $key ) ) {
            $sql->where( '`key` = ?', $key );
        }

        $rowSet = $this->fetchAll($sql);

        $this->translateTypeName( $rowSet );

        if ( $formatForSelect === true ) {

            $out = [];
            foreach( $rowSet as $item ){
                $out[ $item['key'] ] = $item['type_name'];
            }

            return $out;

        }

        return $rowSet;

    }


    /**
     * @param $referenece
     * @return string
     */
    public function getTypeListStringByReferenece ( $referenece ) {

        $types = $this->getTypeListKeysAsArray( $referenece );
        return "'" . implode("','", $types ) . "'";

    }

    ### Utility Functions ###

    private function translateTypeName( Zend_Db_Table_Rowset_Abstract & $rowset ) {
        foreach( $rowset as $row ) {
            $row->type_name = $this->_translate->translate( $row->type_name );
        }
    }


    ### DEPRECATED ###

    public function getLocaleListByStringList ( $aList ) {
        
        $select = $this->select()->
            from( $this, array('reference', 'type_name'))->
            where( 'reference IN(?)', $aList )->
            order( 'sort_order' );
        
        $response = $this->fetchAll( $select );
        
        return $response->toArray();
        
    }

    public function getTypeByReferenceAndName ( $reference, $type_name )
    {
        // returns a Zend Rowset that we convert into an array of Type objects
        $sql = $this->select()->
            where(  'reference = ?',     $reference)->
            where(  '(type_name = ?',    $type_name )->
            orWhere('`key` = ?)',        $type_name )->
            where(  'active = ?',        1 )->
            where(  'deleted = ?',       0 );
        
        return $this->fetchRow($sql);

    }

    public function getTypeListKeysAsArray( $reference ) {

        $sql = $this->select()->
            where( 'reference = ?', $reference)->
            where( 'active = ?', 1 )->
            where( 'deleted = ?', 0 );

        $response = $this->fetchAll($sql);

        $out = [];
        foreach( $response as $type ){
            $out[] = $type['type_id'];
        }

        return $out;

    }

    public function getTypeListByReferenceWithKey ( $reference ) {
        
        $sql = $this->select()->
            where( 'reference = ?', $reference)->
            where( 'active = ?', 1 )->
            where( 'deleted = ?', 0 )->
            order( 'sort_order' );
        
        // pr( $sql->assemble() );
        
        $response = $this->fetchAll($sql);
        
        $out = array();
        foreach( $response as $item ){
            $out[ $item['key'] ] = array( 
                        'type_name' => $item['type_name'] , 
                        'type_id'   => $item['type_id'],
                    ); 
        }
        
        return $out;
            
    }


}
