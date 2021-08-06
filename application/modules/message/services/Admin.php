<?php

class Message_Service_Admin extends Core_Service_Webservice
{
    use Message_Service_MessageTrait;
    use Message_Service_NotificationTrait;

    protected $_auth;
    protected $_acl;
    protected $_translate;
    protected $_utility;

    protected $_messageModel;
    protected $_notificationModel;
    protected $_templateService;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_utility     = new Core_Service_Utility;
        $this->_form        = new Message_Form_Message;

        $this->_messageModel        = new Message_Model_Message;
        $this->_notificationModel   = new Message_Model_Notification;
        $this->_templateService     = new Message_Service_Template;

        parent::__construct( $input );

    }

}
