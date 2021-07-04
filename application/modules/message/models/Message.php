<?php

class Message_Model_Message extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'message';
    protected $_primary     = 'message_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';
    
    public function init ( ) {
        
    }

    /**
     * getMessageById
     * 
     * Gets a message by the message_id
     * 
     * @param uuid (string) $message_id
     * @return object of message (table row) 
     */
    public function getMessageById ( $message_id ) {
        
        $sql = $this->
                    select()->
                        where('message_id = ?', $message_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getMessageList ( ) {
        
        $sql = $this->
            select()->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchAll( $sql );
        
    }

    public function getMessageDBConfigs ( ) {

        $messageRowset = $this->getMessageList();
        $messages = [];
        foreach ( $messageRowset as $messageRow ) {
            $messages[ $messageRow->message_id ] = $messageRow->toArray();
        }
        return new Zend_Config( $messages, true );

    }

    /**
     * Searches and returns a list of messages based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminMessageSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->select()->
            where( '( title LIKE ?', "%$search%" )->
            orWhere( 'message LIKE ?', "%$search%" )->
            orWhere( 'target LIKE ?', "%$search%" )->
            orWhere( 'format LIKE ?', "%$search%" )->
            orWhere( 'route LIKE ?', "%$search%" )->
            orWhere( 'locale LIKE ?', "%$search%" )->
            orWhere( 'type_status LIKE ?', "%$search%" )->
            orWhere( 'send_users LIKE ?', "%$search%" )->
            orWhere( 'send_roles LIKE ?', "%$search%" )->
            orWhere( 'send_orgs LIKE ? )', "%$search%" )->
            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

}
