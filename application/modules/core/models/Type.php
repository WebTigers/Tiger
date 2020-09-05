<?php

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

    /**
     * @param $reference
     * @param false $formatForSelect
     * @param string $locale
     * @return array | Zend_Db_Table_Rowset_Abstract
     */
    public function getTypeListByReference ( $reference, $formatForSelect = false ) {
        
        $sql = $this->select()->
            where( 'reference = ?', $reference)->
            where( 'active = ?', 1 )->
            where( 'deleted = ?', 0 )->
            order( 'sort_order' );
        
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

    /**
     * @param $referenece
     * @return string
     */
    public function getTypeListStringByReferenece ( $referenece ) {

        $types = $this->getTypeListKeysAsArray( $referenece );
        return "'" . implode("','", $types ) . "'";

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

    ### Utility Functions ###

    private function translateTypeName( Zend_Db_Table_Rowset_Abstract & $rowset ) {
        foreach( $rowset as $row ) {
            $row->type_name = $this->_translate->translate( $row->type_name );
        }
    }

}
