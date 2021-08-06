<?php

class Message_Model_Notification extends Zend_Db_Table_Abstract {
    
    protected $_name        = 'notification';
    protected $_primary     = 'notification_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';
    
    public function init ( ) {
        
    }

    /**
     * getNotificationById
     * 
     * Gets a notification by the notification_id
     * 
     * @param uuid (string) $notification_id
     * @return object of notification (table row) 
     */
    public function getNotificationById ( $notification_id ) {
        
        $sql = $this->
            select()->
            where('notification_id = ?', $notification_id);
        
        return $this->fetchRow( $sql );
        
    }

    /**
     * getNotificationByUserIdMessageId
     * 
     * Gets a notification by the user_id and the message_id which should be unique.
     * 
     * @param $user_id
     * @param $message_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getNotificationByUserIdMessageId ( $user_id, $message_id ) {
        
        $sql = $this->
            select()->
            where('user_id = ?', $user_id)->
            where('message_id = ?', $message_id);

        return $this->fetchRow( $sql );
        
    }

    public function getNotificationsByMessageId ( $message_id ) {

        $sql = $this->
        select()->
        from( $this, ['user_id'] )->
        where('message_id = ?', $message_id);

        return $this->fetchAll( $sql );

    }

    /**
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getNotificationList ( ) {
        
        $sql = $this->
            select()->
            where( 'active = 1' )->
            where( 'deleted = 0' );

        return $this->fetchAll( $sql );
        
    }

    /**
     * Searches and returns a list of notifications based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminNotificationSearchList ( $search, $offset = 0, $limit = 0, $orderby = '' ) {

        $sql = $this->select()->
            where( '( module_name LIKE ?', "%$search%" )->
            orWhere( 'notification_name LIKE ?', "%$search%" )->
            orWhere( 'notification_description LIKE ?', "%$search%" )->
            orWhere( 'notification LIKE ?', "%$search%" )->
            orWhere( 'privilege LIKE ? )', "%$search%" )->
            order( $orderby)->
            limit( $limit, $offset );

        return $this->fetchAll( $sql );

    }

    public function getUsersByMessageParams( $userIds, $roleNames, $orgIds )
    {
        $sql = $this->
        select()->
        setIntegrityCheck(false)->  // We need this for any kind of join where updates cannot be performed.
        distinct()->
        from( [ 'ou' => 'org_user'], [] )->
        joinLeft( [ 'o' => 'org'], 'o.org_id = ou.org_id', [] )->
        joinLeft( [ 'u' => 'user'], 'u.user_id = ou.user_id', [ 'u.user_id' ] )->

        where("( u.user_id IN (?)", $userIds )->
        orWhere('u.role IN (?)', $roleNames )->
        orWhere('o.org_id IN (?) )', $orgIds )->

        where('ou.active = 1')->
        where('ou.deleted = 0')->

        where('u.active = 1')->
        where('u.deleted = 0')->

        where('o.active = 1')->
        where('o.deleted = 0');

        // pr( $sql->assemble() );

        return $this->fetchAll( $sql );
    }

    public function getNotificationListByUserId( $user_id, $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {
        $fields = [
            'notification_id'   => 'n.notification_id',
            'message_id'        => 'm.message_id',
            'title'             => 'm.title',
            'message'           => 'm.message',
            'format'            => 'm.format',
            'icon_class'          => 'm.icon_class',
            'dismissible'       => 'm.dismissible',
            'start_date'        => 'm.start_date',
            'link'              => 'm.link',
            'link_new'          => 'm.link_new',
        ];

        $sql = $this->
        select()->
        setIntegrityCheck(false)->  // We need this for any kind of join where updates cannot be performed.
        from( [ 'n' => 'notification'], [] )->
        joinLeft( [ 'm' => 'message'], 'n.message_id = m.message_id', $fields )->

        where("n.user_id = ?", $user_id )->

        /**
         * This search isn't going to work very well with translation keys, so make
         * sure your translation keys have good keywords that pertain to the message!
         */
        where('( m.title LIKE ?', "%$search%" )->
        orWhere('m.message LIKE ? )', "%$search%" )->

        where( "Date(CURRENT_DATE) BETWEEN Date(m.start_date) AND Date(m.end_date)" )->

        where('m.type_status = ?', 'PUBLISHED')->
        where('m.active = 1')->
        where('m.deleted = 0')->

        where('n.active = 1')->
        where('n.deleted = 0')->

        order( $orderby )->
        limit( $limit, $offset );

        // pr( $sql->assemble() );

        return $this->fetchAll( $sql );

    }

    public function getUserCount( $userIds, $roleNames, $orgIds )
    {
        /** This needs to join with the org table so that we make sure the org is active too. */

        $sql = $this->
        select()->
        setIntegrityCheck(false)->  // We need this for any kind of join where updates cannot be performed.
        from( [ 'ou' => 'org_user'], [ 'total' => new Zend_Db_Expr('COUNT( DISTINCT u.user_id )') ] )->
        joinLeft( [ 'o' => 'org'], 'o.org_id = ou.org_id', [] )->
        joinLeft( [ 'u' => 'user'], 'u.user_id = ou.user_id', [] )->

        where("( u.user_id IN (?)", $userIds )->
        orWhere('u.role IN (?)', $roleNames )->
        orWhere('o.org_id IN (?) )', $orgIds )->

        where('ou.active = 1')->
        where('ou.deleted = 0')->

        where('u.active = 1')->
        where('u.deleted = 0')->

        where('o.active = 1')->
        where('o.deleted = 0');

        // pr( $sql->assemble() );

        return $this->fetchRow( $sql );

    }

}
