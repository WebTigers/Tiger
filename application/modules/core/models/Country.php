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
 * Class Core_Model_Country
 */
class Core_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name    = 'country';
    protected $_primary = 'code';

    protected $_locale;

    public function init()
    {
        parent::init();
        
        $this->_locale = Zend_Registry::get('Zend_Locale');

    }

    public function getCountries ( ) {

        $loc = $this->_locale->toString();
        
        $pattern = $this->_getRegexValidationList();
        
        /** If the language validates as one Jarvis knows, great! Otherwise, just use English. */
        $column = ( preg_match($pattern, $loc ) ) 
            ? 'name_' . $this->_locale->getLanguage()
            : 'name_en';
        
        $sql = $this->
                select()->
                from( 'country', ['code' => 'code_3', 'country' => $column ] )->
                where( 'code_3 IS NOT NULL' )->
                order(array('sort DESC', 'country ASC'));
        
        return $this->fetchAll($sql);

    }
    
    public function getLocalizedCountryNameByCode ( $code ) {
        
        $loc = $this->_locale->toString();
        
        $pattern = $this->_getRegexValidationList();

        /** If the language validates as one Jarvis knows, great! Otherwise, just use English. */
        $column = ( preg_match($pattern, $loc ) ) 
            ? 'name_' . $this->_locale->getLanguage()
            : 'name_en';
        
        $abbr_col = ( strlen( $code ) === 2 )
            ? 'code'
            : 'code_3';
        
        $sql = $this->
                select()->
                from( 'country', [ 'code' => $abbr_col, 'country' => $column ] )->
                where( $abbr_col . ' = ?', $code );
        
        $countryRow = $this->fetchRow( $sql );

        return ( ! empty( $countryRow ) ) ? $countryRow->country : null;
        
    }

    public function getCountryAttribsByCode ( $code ) {
        
        $abbr_col = ( strlen( $code ) === 2 )
            ? 'code'
            : 'code_3';
        
        $sql = $this->
                select()->
                where( $abbr_col . ' = ?', $code );
        
        return $this->fetchRow( $sql );
        
    }

}
