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

class Core_Model_ResponseObjectDT
{
    /**
     *
     * @var int
     */
    public $draw;

    /**
     *
     * @var int
     */
    public $recordsTotal;

    /**
     *
     * @var int
     */
    public $recordsFiltered;

    /**
     *
     * @var mixec
     */
    public $data;

    /**
     *
     * @var mixed
     */
    public $error;

    /**
     * Response login tells us if we need to login again. This value is set
     * with (user_role === "guest"). If it is true, then a new login is needed.
     *
     * @var bool
     */
    public $login = false;

    public function __construct( array $params = [] )
    {
        foreach ( $params as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Returns an array of the public response properties.
     * @return array
     */
    public function toArray ( )
    {
        return [
            'draw'              => $this->draw,
            'recordsTotal'      => $this->recordsTotal,
            'recordsFiltered'   => $this->recordsFiltered,
            'data'              => $this->data,
            'error'             => $this->error,
            'login'             => $this->login,
        ];
    }
    
}
