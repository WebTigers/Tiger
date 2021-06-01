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

class Account_Service_Admin extends Core_Service_Webservice
{
    /** Within Tiger, traits are more used for code organization. */

    use Account_Service_OrgTrait;
    use Account_Service_UserTrait;
    use Account_Service_AddressTrait;
    use Account_Service_ContactTrait;

    protected $_auth;
    protected $_acl;
    protected $_translate;
    protected $_utility;

    protected $_userModel;
    protected $_orgModel;
    protected $_contactModel;
    protected $_addressModel;
    protected $_countryModel;
    protected $_orgUserModel;
    protected $_orgContactModel;
    protected $_orgAddressModel;
    protected $_userContactModel;
    protected $_userAddressModel;

    protected $_typeModel;
    protected $_roleModel;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_utility     = new Core_Service_Utility();

        $this->_userModel           = new Account_Model_User();
        $this->_orgModel            = new Account_Model_Org();
        $this->_addressModel        = new Account_Model_Address();
        $this->_countryModel        = new Account_Model_Country();
        $this->_contactModel        = new Account_Model_Contact();
        $this->_orgUserModel        = new Account_Model_OrgUser();
        $this->_orgAddressModel     = new Account_Model_OrgAddress();
        $this->_orgContactModel     = new Account_Model_OrgContact();
        $this->_userAddressModel    = new Account_Model_UserAddress();
        $this->_userContactModel    = new Account_Model_UserContact();

        $this->_typeModel           = new Core_Model_Type();
        $this->_roleModel           = new Acl_Model_AclRoles();

        parent::__construct( $input );

    }

    ### Validation Methods ###

    protected function _validateDataTables ( Array $post ) {

        // pr($post);

        $regexValidator = new Zend_Validate_Regex( array('pattern' => '/^[A-Za-z0-9 \'\.\_\-,]+$/') );
        $intValidator   = new Zend_Validate_Int();

        $out = array();

        if ( ! empty($post['search']) && ! $regexValidator->isValid( $post['search'] ) ) {
            foreach ( $regexValidator->getMessages() as $messageId => $message ) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['start'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['length'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        return ( empty($out) ) ? true : $this->_searchErrors = $out;

    }

    ### Protected Admin Service Functions ###

    /**
     * Sets the identity of a user using the user_id and org_id within an array. This function cannot
     * be called by the Tiger API since it is both protected and requires both $userRow and $orgRow data.
     *
     * @param $data
     * @throws Zend_Auth_Storage_Exception
     */
    protected function _setIdentity( $userRow, $orgRow )
    {
        $identityObject = new Account_Model_IdentityObject( $userRow, $orgRow );
        Zend_Auth::getInstance()->getStorage()->write( (object) $identityObject->toArray() );
    }

    ### Public Account Service Functions ###

    public function getTypeSelect2List ( $params )
    {
        $this->_response = $this->_utility->getTypeSelect2List( $params );
    }

}
