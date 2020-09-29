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

class Core_Model_Translation extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'translation';
    protected $_primary     = 'translation_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function getLocales () {

        $sql = $this->select()->
            distinct()->
            from( $this, ['locale'] );

        return $this->fetchAll( $sql );

    }

    public function getLocaleOptions ( ) {

        $localeRowset = $this->getLocales();
        $localeArray = [];
        foreach ( $localeRowset as $localeRow ) {
            $localeArray[ $localeRow->locale ] = $localeRow->locale;
        }
        return $localeArray;

    }

    public function getTranslationById ( $translation_id ) {

        $sql = $this->
            select()->
            where('translation_id = ?', $translation_id );

        // pr ( $sql->assemble() );

        return $this->fetchRow( $sql );

    }

    public function getTranslationsForCache ( ) {

        $sql = $this->
            select()->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        // pr ( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    public function getTranslationsByLocale ( $locale ) {

        $sql = $this->
            select()->
            where( 'locale = ?', $locale )->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        // pr ( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    public function getTranslationsByKey ( $key ) {

        $sql = $this->
            select()->
            where('msg_id = ?', $key );

            // pr ( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    public function getTranslationListSearch ( $search, $active, $deleted, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
            select()->
            where( 'active = ?', $active )->
            where( 'deleted = ?', $deleted )->
            where( '( msg_id LIKE ?',   "%$search%" )->
            orwhere( 'msg_str LIKE ?', "%$search%" )->
            orWhere( 'locale LIKE ? )', "%$search%" )->
            order( $orderby )->
            limit( $limit, $offset );

        // pr( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

}
