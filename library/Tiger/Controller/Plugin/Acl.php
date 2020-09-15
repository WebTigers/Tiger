<?php

class Tiger_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    protected $_acl;
    protected $_auth;
    protected $_hasRun = false;

    const ROLE_GUEST = "guest";

    /**
     * The ACL Plugin's preDispatch is responsible for validating that we
     * have a resource for the route and that we are allowed to access it.
     *
     * @param Zend_Controller_Request_Abstract $request
     * @throws Zend_Exception
     */
    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
        /** We only want this running once in the startup loop. */
        if ( $this->_hasRun === true ) {
            return;
        }

        $this->_auth = Zend_Auth::getInstance();

        $this->initializeAcl();
        $this->validateResource( $request );
        $this->validateAccess( $request );

        $this->_hasRun = true;

    }

    public function initializeAcl()
    {
        try {

            /** Init ACL */
            $zend_acl = new Acl_Service_Acl();
            $this->_acl = $zend_acl;
            Zend_Registry::set('Zend_Acl', $zend_acl);

        }
        catch ( \Error $e ) {
            throw new Tiger_Exception_Acl( $e->getMessage(), $e->getCode(), null );
        }
        catch ( \Exception $e ){
            throw new Tiger_Exception_Acl( $e->getMessage(), $e->getCode(), $e );
        }

    }

    public function validateResource ( $request )
    {

        $module = ucfirst( strtolower($request->getModuleName()) );
        $controller = ucfirst( strtolower($request->getControllerName()) );
        $resource = $module . '_Controller_' . $controller;

        if ( $this->_acl->has($resource) !== true ) {
            throw new Tiger_Exception_AclNoResource('ERROR.NO_RESOURCE');
        }

    }

    public function validateAccess ( $request )
    {
        $role = $this->_auth->getIdentity()->role;

        $module = ucfirst( strtolower($request->getModuleName()) );
        $controller = ucfirst( strtolower($request->getControllerName()) );
        $resource = $module . '_Controller_' . $controller;

        $action = strtolower($request->getActionName());

        if ( ! $this->_acl->isAllowed( $role, $resource, $action ) ) {

            // Elegantly handle not allowed with a redirect to the login page.

            // Remember where we were going to we can send the user back there once they login.
            Zend_Registry::get('Zend_Session')->aclRequest = $this->_request;

            Zend_Controller_Front::getInstance()->getResponse()->setRedirect('/login');

        }

    }

}