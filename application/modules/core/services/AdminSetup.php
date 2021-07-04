<?php

class Core_Service_AdminSetup extends Core_Service_Webservice
{
    protected $_utility;
    protected $_translate;
    protected $_userModel;
    protected $_rulesModel;
    protected $_orgModel;

    public function __construct( $input ) {

        $this->_utility         = new Core_Service_Utility();
        $this->_translate       = Zend_Registry::get('Zend_Translate');
        $this->_form            = new Core_Form_Setup();
        $this->_userModel       = new Account_Model_User;
        $this->_rulesModel      = new Acl_Model_AclRules;
        $this->_orgModel        = new Account_Model_Org;

        parent::__construct( $input );

    }

    public function setup ( $params ) {

        // pr( $params );

        /**
         * Note that in Tiger, isValid() is subclassed to remove any request routing params that are not part of the
         * form. If you wish to preserve the entire $params array, call the $form->isValidPreserve() method instead.
         */
        if ( ! $this->_form->isValid( $params ) ) {

            /** We use a convenience method to set the form errors into the responseObject and we're done here. */
            $this->_setFormErrors();
            $this->_response->setTextMessage( 'ERROR.CORRECT_FORM_ERRORS', 'error' );
            return;

        }

        /** Gets the filtered and validated values from the form. We've got clean data. */
        $data = $this->_form->getValues();

        // pr( $data );

        try {

            /** Create a new DB user with full privileges. */
            $this->_createNewDBUser( $data );

            /** Update the restricted.ini config with new database user. */
            $this->_updateRestrictedIni( $data );

            /** This cannot be done until we have new encryption keys. */
            $this->_createNewAdminUser( $data );

            /** Set the Tiger user to inactive so they cannot login again. */
            $this->_disableTigerUser();

            /** Register the user if they have provided data. */
            $this->_sendRegistration( $data );

            /** Disable AdminSetup Service Rule */
            $this->_disableAdminSetup();

            /** Disable Old Root User */
            $this->_disableRootUser();

            /** Populate the responseObject with the good news. */
            $this->_response->result = 1;
            $this->_response->setTextMessage( 'MESSAGE.SETUP_COMPLETE', 'success' );

        }
        catch ( Error | Exception $e ) {

            /** Populate the responseObject with the bad news. */
            $this->_response->result = 0;
            $this->_response->setTextMessage( 'ERROR.SETUP_FAILED', 'error' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    private function _createNewDBUser ( $params ) {

        $PDO = $this->_userModel->getAdapter()->getConnection();

        $dbUser = $params['db_username'];
        $dbPass = $params['db_password'];

        try {
            $command = "CREATE USER '$dbUser'@'localhost' IDENTIFIED BY '$dbPass'";
            $PDO->exec( $command );

            $command = "CREATE USER '$dbUser'@'127.0.0.1' IDENTIFIED BY '$dbPass'";
            $PDO->exec( $command );

            $command = "CREATE USER '$dbUser'@'::1' IDENTIFIED BY '$dbPass'";
            $PDO->exec( $command );
        }
        catch ( PDOException $e ) {
            Tiger_Log::error("SETUP ERROR: Command failed: " . $command );
            throw $e;
        }

        Tiger_Log::file("SETUP: New DB user: $dbUser created.");

        try {
            $command = "GRANT ALL PRIVILEGES ON *.* TO '$dbUser'@'localhost' WITH GRANT OPTION";
            $PDO->exec( $command );

            $command = "GRANT ALL PRIVILEGES ON *.* TO '$dbUser'@'127.0.0.1' WITH GRANT OPTION";
            $PDO->exec( $command );

            $command = "GRANT ALL PRIVILEGES ON *.* TO '$dbUser'@'::1' WITH GRANT OPTION";
            $PDO->exec( $command );
        }
        catch ( PDOException $e ) {
            Tiger_Log::error("SETUP ERROR: Command failed: " . $command );
            throw $e;
        }

        $PDO->exec("FLUSH PRIVILEGES");

        Tiger_Log::file("SETUP: New DB privileges granted to user: $dbUser.");

    }

    private function _updateRestrictedIni ( $params ) {

        $settings = [

            [
                'key' => 'resources.db.params.username',
                'value' => $params['db_username'],
            ],
            [
                'key' => 'resources.db.params.password',
                'value' => $params['db_password'],
            ],

            [
                'key' => 'encryption.key',
                'value' => $params['encryption_key'],
            ],
            [
                'key' => 'encryption.iv',
                'value' => $params['encryption_iv'],
            ],

            [
                'key' => 'resources.mail.transport.host',
                'value' => $params['smtp_host'],
            ],
            [
                'key' => 'resources.mail.transport.username',
                'value' => $params['smtp_username'],
            ],
            [
                'key' => 'resources.mail.transport.password',
                'value' => $params['smtp_password'],
            ],
            [
                'key' => 'resources.mail.transport.auth',
                'value' => $params['smtp_auth'],
            ],
            [
                'key' => 'resources.mail.transport.ssl',
                'value' => $params['smtp_ssl'],
            ],
            [
                'key' => 'resources.mail.transport.port',
                'value' => $params['smtp_port'],
            ],

            [
                'key' => 'github_oauth.token',
                'value' => $params['github_oauth_token'],
            ],

        ];

        foreach ( $settings as $setting ) {

            $key = $setting['key'];
            $val = $setting['value'];

            $command = "sed -ie 's/\({$key} = \)\(.*\)/\\1\"{$val}\"/' /var/www/tiger-config/tiger-restricted.ini";
            $response = shell_exec( $command );

            if ( ! empty( $response ) ) {
                Tiger_Log::error( $response );   // Goes to the php-error.log
            }

        }

    }

    private function _createNewAdminUser ( $params ) {

        $userRow = $this->_userModel->createRow([
            'user_id'       => Tiger_Utility_Uuid::v1(),
            'username'      => $params['admin_username'],
            'password'      => Tiger_Utility_Cryption::hash( $params['admin_password'] ),
            'email'         => $params['admin_email'],
            'first_name'    => $params['admin_first_name'],
            'last_name'     => $params['admin_last_name'],
            'role'          => 'superadmin',
            'create_ip'     => $_SERVER['REMOTE_ADDR'],
            'update_ip'     => $_SERVER['REMOTE_ADDR'],
        ]);

        $userRow->saveRow();

        $orgUserRow = $this->_userModel->createRow([
            'org_user_id'       => Tiger_Utility_Uuid::v1(),
            'org_id'            => $this->_orgModel->getOrgDefault()->org_id,
            'user_id'           => $userRow->user_id,
            'type_user_role'    => 'ADMIN',
        ]);

        $orgUserRow->saveRow();

    }

    private function _disableTigerUser ( ) {

        $userRow = $this->_userModel->getUserByUsername( 'tiger' );
        $userRow->active = 0;
        $userRow->saveRow();

    }

    private function _sendRegistration ( $params ) {

        $register = [
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'company_name' => $params['company_name'],
            'email' => $params['email'],
            'country' => $params['country'],
            'type_profession' => $params['type_profession'],
            'type_hearabout' => $params['type_hearabout'],

            'version' => $this->_config->tiger->platform->version,
            'host' => $this->_config->tiger->platform->host,
            'platform' => $this->_config->tiger->platform->platform,
            'framework' => $this->_config->tiger->platform->framework,

            'service' => 'register:admin',
            'method' => 'register',
        ];

        // API URL to send data
        $url = $this->_config->tiger->register_url;

        // curl initiate
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $register );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $response  = curl_exec( $ch );

        curl_close( $ch );

        // $this->_response = $response;

    }

    private function _disableAdminSetup ( ) {

        $ruleRow = $this->_rulesModel->getRuleByName( 'Core Service AdminSetup' );
        $ruleRow->active = 0;
        $ruleRow->saveRow();

    }

    private function _disableRootUser ( ) {

        $PDO = $this->_userModel->getAdapter()->getConnection();

        $rootPassword = Tiger_Utility_Uuid::v4();

        /** Change the root user password away from "tiger". */
        $pw1 = $PDO->exec("SET PASSWORD FOR 'root'@'127.0.0.1' = PASSWORD('$rootPassword')");
        $pw2 = $PDO->exec("SET PASSWORD FOR 'root'@'::1' = PASSWORD('$rootPassword')");
        $pw3 = $PDO->exec("SET PASSWORD FOR 'root'@'localhost' = PASSWORD('$rootPassword')");

        if ( $pw1 === false || $pw2 === false || $pw3 === false ) {
            throw new Exception('Could not reset root user password.');
        }
        Tiger_Log::file("SETUP: DB user root password updated to random UUID.");

        $PDO->exec("FLUSH PRIVILEGES");
        Tiger_Log::file("SETUP: DB privileges flushed.");

    }

}
