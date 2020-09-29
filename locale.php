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

/** Define a default locale. (Optional) */
defined('DEFAULT_LOCALE')
    || define('DEFAULT_LOCALE', 'en_US');

/**
 * Define Locale Regex
 * This is used to match specific routing where a locale is used in the URL.
 *
 *     myapp.com/en_US/path/to/something
 *     myapp.com/en/path/to/something
 *
 * will automagically force / set the default locale for translation regardless
 * of other user settings. Note that if you do not have any translations for the
 * language, your bare translation keys will show. How embarrassing!
 */
defined('LOCALE_REGEX')
    || define('LOCALE_REGEX', '^[a-z]{2}(?:_[A-Z]{2})?$');

/** Attempt to discern if a locale exists within the first position of the uri string ... */

$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
$locale_part = ( isset( $uri_parts[1] ) ) ? $uri_parts[1] : null;
$locale = ( Zend_Locale::isLocale( $locale_part ) )
    ? $locale_part
    : 'auto';

/** If no locale URI string exists, check to see if we have a locale cookie set ... */

if ( $locale === 'auto' ) {
    $locale = (isset($_COOKIE['locale']) && Zend_Locale::isLocale($_COOKIE['locale']))
        ? $_COOKIE['locale']
        : 'auto';
}

/** Set our locale based on the existing locale or Zend's locale auto-detection. */

$locale = new Zend_Locale( $locale );
setcookie( 'locale', $locale->toString(), time()+(360*24*365), '/' );

/** Finally, set the locale as a constant and within the registry for other locale-aware components to find. */

Zend_Registry::set( 'Zend_Locale', $locale );

defined('LOCALE')
    || define('LOCALE', $locale->toString());
