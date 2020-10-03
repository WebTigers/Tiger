<?php

class Acl_Bootstrap extends Zend_Application_Module_Bootstrap
{

    public function _initModule()
    {

        /**
         * The following code block reads all of the config folder's .ini files and adds those configs
         * to the global config object based on the application environment.
         */

        $config = Zend_Registry::get( 'Zend_Config' );

        /** Return an array of only .ini config files from the /configs folder */
        $configFiles = preg_grep('/.*\.(ini)/', scandir( realpath(dirname(__FILE__) . '/configs' ) ) );

        foreach( $configFiles as $configFile ) {
            $filename = realpath(dirname(__FILE__) . '/configs' ) . '/' . $configFile;
            $configOptions = new Zend_Config_Ini( $filename, APPLICATION_ENV, [ 'allowModifications' => true ] );
            $config->merge( $configOptions );
        }

        Zend_Registry::set( 'Zend_Config', $config );


        /** Init Module Translation */
        $moduleTranslate = new Zend_Translate([
            'adapter' => Zend_Translate::AN_ARRAY,
            'content' => realpath(dirname(__FILE__) . '/languages' ),
            'scan' => Zend_Translate::LOCALE_DIRECTORY,
            'locale'  => LOCALE
        ]);
        Zend_Registry::get('Zend_Translate')->addTranslation([ 'content' => $moduleTranslate ]);
        unset( $moduleTranslate );

    }

}

