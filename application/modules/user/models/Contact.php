<?php

class User_Model_Contact extends Zend_Db_Table_Abstract
{
    protected $_name        = 'contact';
    protected $_primary     = 'contact_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    /**
     * @param $contact_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getUserById ( $contact_id )
    {
        return $this->fetchRow( $this->select()->where('contact_id = ?', $contact_id) );
    }

}
