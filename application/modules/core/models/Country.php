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

    protected $_locale;
    protected $_translate;

    public function init()
    {
        parent::init();

        $this->_locale = Zend_Registry::get('Zend_Locale');
        $this->_translate = Zend_Registry::get('Zend_Translate');

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

    public function getCountrySearchList ( string $search, $offset = 0, $limit = 0 ) {

        /** If the language validates as one Tiger knows, great! Otherwise, just default to English. */
        $loc = $this->_locale->toString();
        $pattern = $this->_getRegexLocaleValidationList();
        $locName = ( preg_match($pattern, $loc ) )
            ? 'name_' . $this->_locale->getLanguage()
            : 'name_en';

        $sql = $this->
        select()->
        from( $this, ['code' => 'alpha_3', 'name' => $locName ] )->
        where( 'alpha_3 IS NOT NULL' )->
        where( '( country_code LIKE ?', "%$search%" )->
        orWhere( 'alpha_3 LIKE ?', "%$search%" )->
        orWhere( 'alpha_2 LIKE ?', "%$search%" )->
        orWhere( "$locName LIKE ? )", "%$search%" )->
        order( ["sort DESC", "name ASC"] )->
        limit( $limit, $offset );

        return $this->fetchAll($sql);

    }

    /**
     * @return string
     */
    protected function _getRegexLocaleValidationList ()
    {
        /**
         * The objective of the getRegexValidationList is to auto generate a
         * RegEx validation string for the routes to validate against. This
         * list will be based on all of the langugages available within the
         * translation list. Basically if a language folder exists, it will
         * show up here as a valid language. The string generated will look
         * similar to this: ^(en|en_US|es|es_US)$
         */

        $out = "/^(";
        $languages = $this->_translate->getList();
        foreach ($languages as $language) {
            $out .= $language . "|";
        }
        $out = substr($out, 0, -1) . ")$/";  // remove the last "|"
        return $out;
    }


}
