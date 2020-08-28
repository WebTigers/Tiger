<?php

class Tiger_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    protected $_acl;
    protected $_auth;
    protected $_hasRun = false;

    const ROLE_GUEST = "guest";

    /**
     * The Routes Plugin is responsible for collecting and setting the
     * various router routes.
     *
     * @param Zend_Controller_Request_Abstract $request
     * @throws Zend_Exception
     */
    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
        if ( $this->_hasRun === true ) {
            return;
        }

        // pr( $request );

        $this->_acl = Zend_Registry::get('Zend_Acl');
        $this->_auth = Zend_Auth::getInstance();

        $this->validateResource($request);
        $this->validateAccess($request);

        $this->_hasRun = true;

    }

    public function validateResource ( $request )
    {

        $module = strtolower($request->getModuleName());
        $controller = strtolower($request->getControllerName());
        $resource = $module . ':' . $controller;

        if ( $this->_acl->has($resource) !== true ) {
            throw new Tiger_Exception_AclNoResource('ERROR.NO_RESOURCE');
        }

    }

    public function validateAccess ( $request )
    {
        $role = $this->_auth->getIdentity()->role;
        $module = strtolower($request->getModuleName());
        $controller = strtolower($request->getControllerName());
        $action = strtolower($request->getActionName());
        $resource = $module . ':' . $controller;

        if ( ! $this->_acl->isAllowed( $role, $resource, $action ) ) {

            // Elegantly handle not allowed with a redirect to the login page.

            // Remember where we were going to we can send the user back there once they login.
            Zend_Registry::get('Session')->aclRequest = $this->_request;

            $this->redirect('/login');

        }

    }


}