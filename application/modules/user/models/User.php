<?php

class User_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary = 'user_id';
    
    public function init()
    {
    }

    /**
     * @param $user_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getUserById ( $user_id )
    {
        $sql =  $this->
                select()->
                where('user_id = ?', $user_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * @param null $identity
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getUserByIdentity( $identity )
    {
        /** returns a Zend Rowset that we convert into an array of data */

        $sql =  $this->
                select()->
                where('( user_id = ?', $identity)->
                orWhere('username = ?', $identity)->
                orWhere('email = ? )', $identity)->
                where('active = 1')->
                where('deleted = 0');

        return $this->fetchAll($sql);

    }

}
