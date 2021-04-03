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

class Cms_Model_Page extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'page';
    protected $_primary     = 'page_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';
    
    public function init ( ) {
        
    }

    ### CMS Public Functions ###

    /**
     * Returns the CMS Page TableRow by key, typically used by the public-facing
     * pages to retrieve a page of content.
     *
     * @param string $key
     * @param bool $pageOnly
     * @param string $locale
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getPageByKey ( $key, $contentOnly = false, $locale = null ) {

        $sql = $this->
            select()->
            where('`key` = ?', $key)->
            where('active = 1')->
            where('deleted = 0');

        /** If we only want to be able to render content, not partials, etc. */
        if ( $contentOnly === true ) {
            $sql->where('type IN (?)', ['page','blog','doc']);
        }

        /** If we're looking for an article in different languages. */
        if ( ! empty($locale) ) {
            $sql->where('locale = ?', $locale);
        }

        // pr ( $sql->assemble() );

        return $this->fetchRow( $sql );

    }

    /**
     * Returns the CMS Page TableRow by key, typically used by the public-facing
     * pages to retrieve a page of content.
     *
     * @param string $category
     * @param string $key
     * @param bool $pageOnly
     * @param string $locale
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getPageByCategoryKey ( $category, $key, $contentOnly = false, $locale = null ) {

        $sql = $this->
        select()->
        where('category = ?', $category)->
        where('`key` = ?', $key)->
        where('active = 1')->
        where('deleted = 0');

        /** If we only want to be able to render content, not partials, etc. */
        if ( $contentOnly === true ) {
            $sql->where('type IN (?)', ['page','blog','doc']);
        }

        /** If we're looking for an article in different languages. */
        if ( ! empty($locale) ) {
            $sql->where('locale = ?', $locale);
        }

        // pr ( $sql->assemble() );

        return $this->fetchRow( $sql );

    }

    ### CMS Admin Functions ###

    public function getPagesByKey ( $key ) {

        $sql = $this->
            select()->
            from( $this, [
                'page_id',
                'key',
                'name',
                'create_date',
                'update_date',
                'active',
            ])->
            where('`key` = ?', $key)->
            where('deleted = 0')->
            order();

        // pr ( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    public function getLayoutsForSelect2 ( $theme ) {

        $sql = $this->
            select()->
            from( $this, [
                'key',
                'name',
            ])->
            where('theme = ?', $theme)->
            where('type = ?', 'layout')->
            where('active = 1')->
            where('deleted = 0');

        // pr ( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    /**
     * Returns the CMS Page TableRow by page_id regardless of active or deleted status.
     *
     * @param $page_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getPageById ( $page_id ) {

        $sql = $this->
            select()->
            where('page_id = ?', $page_id);

        return $this->fetchRow( $sql );

    }

    /**
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAdminPageSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->
        select()->
        from( $this, [
            'page_id',
            'key',
            'name',
            'type',
            'category',
            'locale',
            'create_date',
            'update_date',
            'active',
            'deleted',
        ])->
        // where( 'active = 1' )->
        where( 'deleted = 0' )->
        where( '( name LIKE ?',      "%$search%" )->
        orwhere( 'type LIKE ?',      "%$search%" )->
        orwhere( 'category LIKE ?',  "%$search%" )->
        orwhere( 'locale LIKE ?',    "%$search%" )->
        orWhere( 'content LIKE ? )', "%$search%" )->
        order( $orderby )->
        limit( $limit, $offset );

        // pr( $sql->assemble() );

        return $this->fetchAll($sql);

    }

    public function getPagesForSelect2 ( $search = '' ) {

        $sql = $this->
            select()->
            from( $this, [
                'page_id',
                'name',
            ])->
            where( '( name LIKE ?',      "%$search%" )->
            orwhere( 'type LIKE ?',      "%$search%" )->
            orwhere( 'category LIKE ?',  "%$search%" )->
            orwhere( 'locale LIKE ?',    "%$search%" )->
            orWhere( 'content LIKE ? )', "%$search%" )->
            where('`type` IN (?)', ['page','blog'])->
            where('active = 1')->
            where('deleted = 0');;

        return $this->fetchAll( $sql );

    }

}
