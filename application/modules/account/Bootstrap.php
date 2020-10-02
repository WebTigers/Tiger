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

class Account_Bootstrap extends Zend_Application_Module_Bootstrap
{

    public function _initModule()
    {

        /**
         * The following code block reads all of the config folder's .ini files and adds those configs
         * to the global config object based on the application environment.
         */

        $Config = Zend_Registry::get( 'Zend_Config' );

        /** Return an array of only .ini config files from the /configs folder */
        $configFiles = preg_grep('/.*\.(ini)/', scandir( realpath(dirname(__FILE__) . '/configs' ) ) );

        foreach( $configFiles as $configFile ) {
            $filename = realpath(dirname(__FILE__) . '/configs' ) . '/' . $configFile;
            $configOptions = new Zend_Config_Ini( $filename, APPLICATION_ENV, [ 'allowModifications' => true ] );
            $Config->merge( $configOptions );
        }

        Zend_Registry::set( 'Zend_Config', $Config );

    }

}
