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

class Core_Model_Session extends Zend_Db_Table_Abstract {
    
    protected $_name = 'session';
    protected $_primary = 'session_id';
    protected $_rowClass = 'Tiger_Db_Table_Row';

    public function init() {
        

    }

    public function getSessionById ( $session_id ) {

        $sql = $this->
        select()->
        where('session_id = ?', $session_id);

        return $this->fetchRow( $sql );

    }

}
