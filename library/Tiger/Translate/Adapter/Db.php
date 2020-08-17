<?php

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
