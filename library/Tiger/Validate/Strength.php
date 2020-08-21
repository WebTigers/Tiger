<?php

class Tiger_Validate_Strength extends Zend_Validate_Abstract {

    const PW_LENGTH    = 'pw_length';
    const PW_UPPER     = 'pw_upper';
    const PW_LOWER     = 'pw_lower';
    const PW_DIGIT     = 'pw_digit';
    const PW_SPECIAL   = 'pw_special';
    const PW_ILLEGAL   = 'pw_illegal';
    const PW_REPEATING = 'pw_repeating';

    protected $_password;

    public $pw_length;
    public $pw_upper;
    public $pw_lower;
    public $pw_digit;
    public $pw_special;
    public $pw_illegal;
    public $pw_repeating;

    protected $_messageVariables = array(
        'pw_length'    => 'pw_length',
        'pw_upper'     => 'pw_upper',
        'pw_lower'     => 'pw_lower',
        'pw_digit'     => 'pw_digit',
        'pw_special'   => 'pw_special',
        'pw_illegal'   => 'pw_illegal',
        'pw_repeating' => 'pw_repeating',
    );

    protected $_messageTemplates = array(
        self::PW_LENGTH    => "'%value%' must be at least '%pw_length%' characters in length",
        self::PW_UPPER     => "'%value%' must contain at least '%pw_upper%' uppercase letter",
        self::PW_LOWER     => "'%value%' must contain at least '%pw_lower%' lowercase letter",
        self::PW_DIGIT     => "'%value%' must contain at least '%pw_digit%' numeric character.",
        self::PW_SPECIAL   => "'%value%' must contain at least '%pw_special%' special character.",
        self::PW_ILLEGAL   => "'%value%' cannot contain '%pw_illegal%'",
        self::PW_REPEATING => "'%value%' cannot contain more than '%pw_repeating%' repeating characters.",
    );

    public function __construct() {
        
        $this->_password = Zend_Registry::get('Zend_Config')->password;
        
        $this->pw_length    = $this->_password->length;
        $this->pw_upper     = $this->_password->upper;
        $this->pw_lower     = $this->_password->lower;
        $this->pw_digit     = $this->_password->digit;
        $this->pw_special   = $this->_password->special;
        $this->pw_illegal   = $this->_password->illegal;
        $this->pw_repeating = $this->_password->repeating;

    }

    public function isValid( $value )
    {
        $this->_setValue( $value );

        $isValid = true;

        if ( strlen($value) < $this->pw_length ) {
            $this->_error(self::PW_LENGTH);
            $isValid = false;
        }

        $pattern = '/[A-Z]{' . $this->pw_upper . ',}/';
        if ( !preg_match($pattern, $value) ) {
            $this->_error(self::PW_UPPER);
            $isValid = false;
        }

        $pattern = '/[a-z]{' . $this->pw_lower . ',}/';
        if ( !preg_match($pattern, $value) ) {
            $this->_error(self::PW_LOWER);
            $isValid = false;
        }

        $pattern = '/[\d]{' . $this->pw_digit . ',}/';
        if ( !preg_match($pattern, $value) ) {
            $this->_error(self::PW_DIGIT);
            $isValid = false;
        }

        $pattern = '/[\W]{' . $this->pw_special . ',}/';
        if ( !preg_match($pattern, $value) ) {
            $this->_error(self::PW_SPECIAL);
            $isValid = false;
        }

        if ( $this->pw_illegal !== '' ) {
            // Reference: /^[(\S)]+$/
            if ( !preg_match($this->pw_illegal, $value) ) {
                $this->_error(self::PW_ILLEGAL);
                $isValid = false;
            }
        }
        
        // Reference: preg_match('/(.)\1{2,}/', $value)
        $pattern = '/(.)\1{' . $this->pw_repeating . ',}/';
        if ( preg_match($pattern, $value) ) {
            $this->_error(self::PW_REPEATING);
            $isValid = false;
        }
        
        return $isValid;
    }
    
    protected function _getStrength ( $value )
    {
        $strength = 0;
        
        // Length
        $strength = strlen($value) * $this->_password->length_value;
        
        // Lowercase
        preg_match_all('/[a-z]/', $value, $match);
        $count = count($match[0]);
        $strength += ($count !== 0) ? $count * $this->_password->lower_value : 0;
        
        // Uppercase
        preg_match_all('/[A-Z]/', $value, $match);
        $count = count($match[0]);
        $strength += ($count !== 0) ? $count * $this->_password->upper_value : 0;
        
        // Digit
        preg_match_all('/[\d]/', $value, $match);
        $count = count($match[0]);
        $strength += ($count !== 0) ? $count * $this->_password->digit_value : 0;
        
        // Special
        preg_match_all('/[\W]/', $value, $match);
        $count = count($match[0]);
        $strength += ($count !== 0) ? $count * $this->_password->special_value : 0;

        return $strength;

    }

}
