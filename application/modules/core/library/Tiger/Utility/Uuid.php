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
 * This class requires the PECL UUID extension.
 *
 * See: https://github.com/php/pecl-networking-uuid
 */

class Tiger_Utility_Uuid {

    const UUID_TYPE_TIME = 1;
    const UUID_TYPE_RANDOM = 4;

    /**
     * @return uuid version 1 time-based
     */
    public static function v1 ( ) {
        return uuid_create( self::UUID_TYPE_TIME );
    }

    /**
     * @return uuid version 4 random
     */
    public static function v4 ( ) {
        return uuid_create( self::UUID_TYPE_RANDOM );
    }

    /**
     * @param $uuid
     * @return boolean
     */
    public static function is_valid ( $uuid ) {
        return uuid_is_valid( $uuid );
    }

    /**
     * @param $uuid
     * @return int 1 = time-based | 4 = random
     */
    public static function type ( $uuid ) {
        return uuid_type( $uuid );
    }

    /**
     * @param $uuid
     * @return mixed unix timestamp from v1 uuid | false if v4 uuid.
     */
    public static function time ( $uuid ) {
        return uuid_time( $uuid );
    }

}
