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

class Tiger_Translate_Adapter_Db extends Zend_Translate_Adapter {

    private $_data = [];

    /**
     * Load translation data
     *
     * @param string $data Not used in this context
     * @param string $locale Locale/Language to add data for, identical with locale identifier, see Zend_Locale for more information
     * @param array $options Not used in this context
     * @return array translation data in associative array
     */
    protected function _loadTranslationData ( $data, $locale, array $options = array() ) {

        $translationModel = new Core_Model_Translation;

        if ( $this->hasCache() ) {

            $translationRowset = $translationModel->getTranslationsForCache();

        } else {

            $translationRowset = $translationModel->getTranslationsByLocale( $locale );

        }

        foreach ( $translationRowset as $translationRow ) {

            if ( $this->hasCache() ) {

                $this->_data[ $translationRow->locale ][ $translationRow->msg_id] = $translationRow->msg_str;

            } else {

                $this->_data[ $locale ][ $translationRow->msg_id ] = $translationRow->msg_str;

            }

        }

        if ( ! isset( $this->_data[ $locale ] ) ) {

            $this->_data[ $locale ] = ['0' => false];

        }

        return $this->_data;

    }

    /**
     * @desc returns the adapters name
     * @return string
     */
    public function toString ( ) {
        return "Db";
    }
}
