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

class Account_Model_UserAddress extends Zend_Db_Table_Abstract
{
    protected $_name        = 'user_address';
    protected $_primary     = 'user_address_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $user_address_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getUserAddressById ( $user_address_id )
    {
        return $this->fetchRow( $this->select()->where( 'user_address_id = ?', $user_address_id ) );
    }

    public function getEntityAddressByEntityId ( $user_id, $address_id ) {
        return $this->fetchRow( $this->select()->where( 'user_id = ?', $user_id )->where( 'address_id = ?', $address_id ) );
    }

}
