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
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getLocales () {

        $sql = $this->select()->
            distinct()->
            from( $this, ['locale'] );

        return $this->fetchAll( $sql );

    }

    /**
     * @return array of database locales with translations
     */
    public function getLocaleOptions ( ) {

        $localeRowset = $this->getLocales();
        $localeArray = [];
        foreach ( $localeRowset as $localeRow ) {
            $localeArray[ $localeRow->locale ] = $localeRow->locale;
        }
        return $localeArray;

    }

    /**
     * @param $translation_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getTranslationById ( $translation_id ) {

        $sql = $this->
            select()->
            where('translation_id = ?', $translation_id );

        return $this->fetchRow( $sql );

    }

    /**
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getTranslationsForCache ( ) {

        $sql = $this->
            select()->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchAll( $sql );

    }

    /**
     * @param string $locale
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getTranslationsByLocale ( string $locale ) {

        $sql = $this->
            select()->
            where( 'locale = ?', $locale )->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchAll( $sql );

    }

    /**
     * @param $message_id
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getTranslationsByMessageId ($message_id) {

        $sql = $this->
            select()->
            where('message_id = ?', $message_id );

        return $this->fetchAll( $sql );

    }

    /**
     * @param string $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getTranslationSearchList ( string $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
            select()->
            where( '( message_id LIKE ?',   "%$search%" )->
            orwhere( 'message_text LIKE ?', "%$search%" )->
            orWhere( 'locale LIKE ? )', "%$search%" )->
            where( 'active = 1' )->
            where( 'deleted = 0' )->
            order( $orderby )->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

    /**
     * @param string $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAdminTranslationSearchList ( string $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
        select()->
        where( '( message_id LIKE ?',   "%$search%" )->
        orwhere( 'message_text LIKE ?', "%$search%" )->
        orWhere( 'locale LIKE ? )', "%$search%" )->
        order( $orderby )->
        limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
