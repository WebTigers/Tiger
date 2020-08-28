<?php

class Tiger_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    const GUEST = "guest";

    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
        $auth = Zend_Auth::getInstance();

        if ( ! $auth->hasIdentity() ) {

            $auth->getStorage()->write( (object)[
                'username' => self::GUEST,
                'role' => self::GUEST,
            ]);

        }


    }

}