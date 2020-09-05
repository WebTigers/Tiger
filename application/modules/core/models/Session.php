<?php

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
