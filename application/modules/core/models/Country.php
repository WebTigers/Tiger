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

class Core_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name        = 'country';
    protected $_primary     = 'country_code';
    protected $_rowClass    = 'Tiger_Db_Table_Row';

    protected $_translate;

    public function init ( ) {

        $this->_translate = Zend_Registry::get( 'Zend_Translate' );

    }

    public function getCountryByCountryCode ( $country_code, $locale = LOCALE ) {

        $locale = new Zend_Locale($locale);
        $column = 'name_' . $locale->getLanguage();

        $sql = $this->select()->
        where('country_code = ?', $country_code );
        
        return $this->fetchRow( $sql );

    }

    public function getCountryByAlpha2 ( $alpha2, $locale = LOCALE ) {

        $locale = new Zend_Locale($locale);
        $column = 'name_' . $locale->getLanguage();

        $sql = $this->select()->
        where('alpha_2 = ?', $alpha2 );

        return $this->fetchRow( $sql );

    }

    public function getCountryByAlpha3 ( $code3, $locale = LOCALE ) {

        $locale = new Zend_Locale($locale);
        $column = 'name_' . $locale->getLanguage();

        $sql = $this->select()->
        where('alpha_3 = ?', $code3 );

        return $this->fetchRow( $sql );

    }

    /**
     * @param string $locale
     * @param bool $formatForSelect
     * @return array|Zend_Db_Table_Rowset_Abstract
     * @throws Zend_Locale_Exception
     */
    public function getCountryList ( $locale = LOCALE, $formatForSelect = true ) {

        $locale = new Zend_Locale($locale);
        $column = 'name_' . $locale->getLanguage();

        $sql = $this->select()->
        from($this, ['alpha_3', $column])->
        order( ['sort DESC', $column . ' ASC'] );

        $countries = $this->fetchAll($sql);

        if ( $formatForSelect === true ) {

            $out = [];
            foreach( $countries as $item ){
                $out[ $item['alpha_3'] ] = $item[ $column ];
            }

            $countries = $out;

        }

        return $countries;

    }

}
