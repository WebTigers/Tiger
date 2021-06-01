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

class Media_Model_Media extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'media';
    protected $_primary     = 'media_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    /**
     * @param $media_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getMediaById ( $media_id ) {

        $sql = $this->
            select()->
            where('media_id = ?', $media_id );

        return $this->fetchRow( $sql );

    }

    /**
     * @param string $locale
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getMediaSearchList ( string $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
            select()->

            where( 'type_media IN (?)', ['public'] )->
            where( '( filename LIKE ?', "%$search%" )->
            orWhere( 'original_filename LIKE ?', "%$search%" )->
            orWhere( 'extension LIKE ?', "%$search%" )->
            orWhere( 'description LIKE ?', "%$search%" )->
            orWhere( 'mime_type LIKE ?', "%$search%" )->
            orWhere( 'tags LIKE ? )', "%$search%" )->

            where( 'active = 1' )->
            where( 'deleted = 0' )->
            order( $orderby )->
            limit( $limit, $offset );

        // pr( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    /**
     * @param string $locale
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getUserMediaSearchList ( string $user_id, string $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
        select()->

        where( 'create_user_id = ?', $user_id )->
        where( 'type_media IN (?)', ['user','avatar'] )->

        where( '( filename LIKE ?', "%$search%" )->
        orWhere( 'original_filename LIKE ?', "%$search%" )->
        orWhere( 'extension LIKE ?', "%$search%" )->
        orWhere( 'description LIKE ?', "%$search%" )->
        orWhere( 'mime_type LIKE ?', "%$search%" )->
        orWhere( 'tags LIKE ? )', "%$search%" )->

        where( 'active = 1' )->
        where( 'deleted = 0' )->
        order( $orderby )->
        limit( $limit, $offset );

        // pr( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    /**
     * @param string $locale
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAdminMediaSearchList ( string $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
            select()->

            where( '( filename LIKE ?', "%$search%" )->
            orWhere( 'original_filename LIKE ?', "%$search%" )->
            orWhere( 'extension LIKE ?', "%$search%" )->
            orWhere( 'description LIKE ?', "%$search%" )->
            orWhere( 'mime_type LIKE ?', "%$search%" )->
            orWhere( 'tags LIKE ? )', "%$search%" )->

            order( $orderby )->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
