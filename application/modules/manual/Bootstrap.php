<?php

class Manual_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected $_config;

    protected function _initModule()
    {
        /**
         * The following code block reads all of the config folder's .ini files and adds those configs
         * to the global config object based on the application environment.
         */
        if ( boolval( Zend_Registry::get('Zend_Config')->tiger->cache->useCache ) === true ) {
            if ( ($this->_config = Zend_Registry::get('Zend_Cache')->load('Zend_Config')) === false ) {
                $this->_loadModuleConfigs();
            }
            else {
                Zend_Registry::set('Zend_Config', $this->_config);
            }
        }
        else {
            $this->_loadModuleConfigs();
        }
    }

    protected function _loadModuleConfigs ( )
    {
        $this->_config = Zend_Registry::get('Zend_Config');

        /** Return an array of only .ini config files from the /configs folder */
        $configFiles = preg_grep('/.*\.(ini)/', scandir(realpath(dirname(__FILE__) . '/configs')));

        foreach ($configFiles as $configFile) {
            $filename = realpath(dirname(__FILE__) . '/configs') . '/' . $configFile;
            $configOptions = new Zend_Config_Ini($filename, APPLICATION_ENV, ['allowModifications' => true]);
            $this->_config->merge($configOptions);
        }

        Zend_Registry::set('Zend_Config', $this->_config);

    }

    protected function _initTranslate()
    {
        /** Init Module Translation */
        $moduleTranslate = [
            'adapter' => Zend_Translate::AN_ARRAY,
            'content' => realpath(dirname(__FILE__) . '/languages' ),
            'scan' => Zend_Translate::LOCALE_DIRECTORY,
            'locale'  => LOCALE,
            'clear' => false,
        ];
        Zend_Registry::get('Zend_Translate')->addTranslation( $moduleTranslate );
    }

}

