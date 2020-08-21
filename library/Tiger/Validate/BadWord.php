<?php

class Tiger_Validate_BadWord extends Zend_Validate_Abstract
{
    const MSG_BADWORD = "badWord";
    
    protected $_badword;
    
    public    $dictionary;

    protected $_messageTemplates = array(
        self::MSG_BADWORD => "Contains an offensive term: %value%. Please remove any offensive terms."
    );
    
    public function __construct() {
        
        $this->_badword = new Application_Model_BadWord;
        $language = Zend_Registry::get( 'Zend_Locale' )->getLanguage();
        $badWordsRec = $this->_badword->getBadwordListByLocale( $language );
        foreach( $badWordsRec as $badWordRec ){
            $this->dictionary[] = $badWordRec->text;
        }
        // pr( $this->dictionary );
        
    }

    /**
     * Accepts a UUID/GUID string to validate. 
     * 
     * @param string $value
     * @return boolean 
     */
    public function isValid( $value, $context = null ) {

        // pr(array($value,$context));
        
        
        $isValid = true;
        
        foreach ( $this->dictionary as $badWord ) {
            
            $val = preg_match( "/\b$badWord\b/i", $value );
            
            if ( $val === 1 ) {
                
                $this->_setValue( $badWord );
                
                $this->_error( self::MSG_BADWORD );
                $isValid = false;
                break;

            }

        }

        return $isValid;

    }

}
