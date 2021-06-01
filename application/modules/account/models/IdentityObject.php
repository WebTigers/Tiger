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
    public $password_reset_key;
    public $avatar_url;

    public $org_id;
    public $parent_org_id;
    public $orgname;
    public $org_display_name;
    public $company_name;

    public function __construct( $userRow = null, $orgRow = null ) {

        $this->setParams( $userRow );
        $this->setParams( $orgRow );

    }

    public function setParams ( $params ) {

        if ( is_array( $params ) || is_object( $params ) ) {
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
            'password_reset_key' => $this->password_reset_key,
            'avatar_url'    => $this->avatar_url,

            'org_id'        => $this->org_id,
            'parent_org_id' => $this->parent_org_id,
            'orgname'       => $this->orgname,
            'org_display_name' => $this->org_display_name,
            'company_name'  => $this->company_name,
        ];
    }
    
}
