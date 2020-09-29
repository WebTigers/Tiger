<?php

class Account_Model_IdentityObject
{

    public $user_id;
    public $username;
    public $user_display_name;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $role;
    public $email;
    public $locale_preference;

    public $org_id;
    public $parent_org_id;
    public $orgname;
    public $org_display_name;
    public $company_name;

    public function __construct( Zend_Db_Table_Row_Abstract $userRow = null, Zend_Db_Table_Row_Abstract $orgRow = null ) {

        $this->setParams( $userRow->toArray() );
        $this->setParams( $orgRow->toArray() );

    }

    public function setParams ( Array $params = null ) {

        if ( is_array( $params ) ) {
            foreach ( $params as $key => $value ) {
                if ( property_exists( $this, $key ) ) {
                    $this->$key = $value;
                }
            }
        }

    }

    /**
     * Returns an array of the public response properties.
     * @return array
     */
    public function toArray()
    {
        return [
            'user_id'       => $this->user_id,
            'username'      => $this->username,
            'user_display_name' => $this->user_display_name,
            'first_name'    => $this->first_name,
            'middle_name'   => $this->middle_name,
            'last_name'     => $this->last_name,
            'role'          => $this->role,
            'email'         => $this->email,
            'locale_preference' => $this->locale_preference,

            'org_id'        => $this->org_id,
            'parent_org_id' => $this->parent_org_id,
            'orgname'       => $this->orgname,
            'org_display_name' => $this->org_display_name,
            'company_name'  => $this->company_name,
        ];
    }
    
}
