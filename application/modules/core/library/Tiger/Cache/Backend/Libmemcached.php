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

/**
 * Class Tiger_Cache_Backend_Libmemcached
 *
 * This class is simply designed to give you access to all of the various Memcached
 * functions that the original Zend adapter didn't. Just add whichever PHP functions
 * are available via Libmemcached as needed.
 */
class Tiger_Cache_Backend_Libmemcached extends Zend_Cache_Backend_Libmemcached implements Zend_Cache_Backend_Interface
{
    /**
     * @param $host
     * @param $port
     * @param $weight
     */
    public function addServer ( $host, $port, $weight = 0 )
    {
        $this->_memcache->addServer( $host, $port, $weight );
    }

    /**
     * @return array
     */
    public function getServerList ( )
    {
        return $this->_memcache->getServerList();
    }

    /**
     * Add additional functions you may need below ...
     * See: https://www.php.net/manual/en/book.memcached.php
     */

}