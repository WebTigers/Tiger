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

class Core_Model_Package extends Zend_Db_Table_Abstract {
    
    protected $_name = 'package';
    protected $_primary = 'package_id';
    protected $_rowClass = 'Tiger_Db_Table_Row';

    public function init() {
    }

    public function getPackageById ( $package_id ) {

        $sql = $this->
        select()->
        where('package_id = ?', $package_id );

        return $this->fetchRow( $sql );

    }

    public function getPackageByName ( $package_name ) {

        $sql = $this->
        select()->
        where('name = ?', $package_name );

        return $this->fetchRow( $sql );

    }

    public function getPackageNames ( ) {

        $sql = $this->
        select()->
        from( $this, ['name'] );

        return $this->fetchAll( $sql );

    }

    public function getAdminPackageSearchList ( $search = '', $offset = 0, $limit = 10, $orderby = '' ) {

        $sql = $this->
        select()->
        where  ( '( name LIKE ?', "%$search%" )->
        orWhere( 'target_version LIKE ?', "%$search%" )->
        orWhere( 'version LIKE ?', "%$search%" )->
        orWhere( 'latest LIKE ?', "%$search%" )->
        orWhere( 'description LIKE ? )', "%$search%" )->
        order  ( $orderby )->
        limit  ( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
