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

abstract class Tiger_Controller_Action extends Zend_Controller_Action {

    public $_config;
    public $_translate;

    public function init ( ) {
        
        parent::init();
        
        // $this->_config          = Zend_Registry::get( 'Zend_Config' );
        // $this->_translate       = Zend_Registry::get( 'Zend_Translate' );

    }
    
    /**
     * 
     */
    public function preDispatch ( ) {

        parent::preDispatch();

        /** Allows us to do stuff within the predispatch phase. */

    }

    /**
     * 
     */
    public function postDispatch ( ) {

        parent::postDispatch();

        /** Allows us to do stuff within the postdispatch phase. */


    }

    /**
     * This stubbed out function is just to let you know that you can create functions that are globally
     * available to your application just by creating controllers that extend this Tiger_Controller_Action.
     */
    public function globalSomething ( )
    {
        // $request            = $this->getRequest();
        // $frontController    = $this->getFrontController();
    }

}
