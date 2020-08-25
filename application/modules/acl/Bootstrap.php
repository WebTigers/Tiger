<?php

class Acl_Bootstrap extends Zend_Application_Module_Bootstrap
{

    public function _initModule()
    {
        /** Init ACL */
        $zend_acl = new Acl_Service_Acl();
        Zend_Registry::set( 'Zend_Acl', $zend_acl );
    }

}

