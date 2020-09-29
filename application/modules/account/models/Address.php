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

    public function init ( ) {
        
    }

    public function getAddressById ( $address_id )
    {
        $sql = $this->
            select()->
            where('address_id = ?', $address_id);

        return $this->fetchRow( $sql );

    }

}
