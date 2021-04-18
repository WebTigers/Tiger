<?php

class Package_Service_Package extends Core_Service_Webservice
{
    use Package_Service_PackageTrait;

    protected $_packageModel;
    protected $_utility;
    protected $_translate;
    protected $_composerService;

    const TIGER_TYPES = ['tiger-module', 'tiger-theme'];

    public function __construct( $input ) {

        $this->_packageModel    = new Package_Model_Package;
        $this->_utility         = new Core_Service_Utility();
        $this->_translate       = Zend_Registry::get('Zend_Translate');
        $this->_composerService = new Package_Service_Composer;

        parent::__construct( $input );

    }

}
