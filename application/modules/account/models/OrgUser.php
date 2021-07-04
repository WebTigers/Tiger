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

class Account_Model_OrgUser extends Zend_Db_Table_Abstract
{
    protected $_name        = 'org_user';
    protected $_primary     = 'org_user_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    protected $_orgModel;
    protected $_userModel;

    public function init()
    {
        $this->_orgModel = new Account_Model_Org();
        $this->_userModel = new Account_Model_User();
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
         * Note that a user may not be associated to an org at all, or may be associated to more than one
         * org at a time. We set an active flag on the org_user record in hopes of tagging a user's primary org.
         */
        $orgUserRow = $this->fetchRow(
            $this->select()->
            where('user_id = ?', $user_id)->
            where( 'active = 1' )->
            where( 'deleted = 0' )
        );

        $orgRow = null;
        if ( ! empty( $orgUserRow ) ) {
            $orgRow = $this->_orgModel->getOrgById( $orgUserRow->org_id );
        }

        return $orgRow;

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
            where( 'org_id IN ( ? )', $orgs )->
            where( 'active = 1' )->
            where( 'deleted = 0' )
        );


    }

    public function getAdminOrgUserListByUserId( $user_id )
    {
        $sql = $this->
        select()->
        setIntegrityCheck(false)->  // We need this for any kind of join where updates cannot be performed.
        from( [ 'ou' => 'org_user'], ['ou.*'] )->
        joinLeft( [ 'o' => 'org'], 'o.org_id = ou.org_id', ['orgname','company_name','org_display_name'] )->
        joinLeft( [ 'u' => 'user'], 'u.user_id = ou.user_id', ['username'] )->
        where('u.user_id = ?', $user_id );

        return $this->fetchAll( $sql );

    }

}
