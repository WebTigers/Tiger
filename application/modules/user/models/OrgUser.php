<?php

class User_Model_OrgUser extends Zend_Db_Table_Abstract
{
    protected $_name        = 'org_user';
    protected $_primary     = 'org_user_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    protected $_orgModel;
    protected $_userModel;

    public function init()
    {
        $this->_orgModel = new User_Model_Org();
        $this->_userModel = new User_Model_User();
    }

    /**
     * @param $org_user_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getOrgUserById ( $org_user_id )
    {
        return $this->fetchRow( $this->select()->where('org_user_id = ?', $org_user_id) );
    }

    public function getOrgByUserId ( $user_id )
    {
        /**
         * Note that this method assumes that a user can only be active with one org at a time.
         * If your business rules allow otherwise, multiple active orgs, use get getOrgsByUserId()
         * instead and not that the function returns multiple orgs within a rowset.
         */
        $orgUserRow = $this->fetchRow(
            $this->select()->
            where('user_id = ?', $user_id)->
            where( 'active = 1' )->
            where( 'deleted = 0' )
        );

        return $this->_orgModel->getOrgById( $orgUserRow->org_id );

    }

    public function getOrgsByUserId ( $user_id )
    {
        /**
         * Note that this method assumes that a user can be a member of multiple orgs. If your business rules
         * allow multiple active orgs, note that this method returns a collection.
         *
         * Note that we could also do this by a join, but then we lose the ability to iterate the orgs in a
         * rowset.
         */
        $orgUserRowset = $this->fetchAll(
            $this->select()->
            where('user_id = ?', $user_id)->
            where( 'active = 1' )->
            where( 'deleted = 0' )
        );

        $orgs = [];
        foreach( $orgUserRowset as $orgUserRow ){
            $orgs[] = $orgUserRow->org_id;
        }

        return $this->fetchAll(
            $this->_orgModel->select()->
            where( "org_id IN ('?')", implode( ',' , $orgs ) )->  // <-- Pay careful attention to the quote syntax here.
            where( 'active = 1' )->
            where( 'deleted = 0' )
        );


    }



}
