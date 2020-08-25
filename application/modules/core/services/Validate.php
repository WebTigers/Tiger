<?php

final class Core_Service_Validate {

    private $_module;
    private $_form;
    private $_response;

    public function __construct( Array $params ) {
        
        if ( isset( $params['module'] ) && 
            isset( $params['form']   ) &&
            Zend_Validate::is( $params['module'], 'Alpha' )  &&
            Zend_Validate::is( $params['form'],   'Alpha' ) )
        {

            $this->_module      = Zend_Filter::filterStatic( $params['module'], 'Alpha');
            
            $formName           = ucfirst( $this->_module ) . '_Form_' . ucfirst( Zend_Filter::filterStatic( $params['form'], 'Alpha') );
            $this->_form        = new $formName;
            
            $this->_response    = new Core_Model_ResponseObject;
            
            $this->validateField( $params );

        }

    }

    public function getResponse() 
    {
        return $this->_response;
    }
    
    public function getForm() 
    {
        return $this->_form;
    }
    
    /**
     * Validate Field
     * 
     * @param array $params
     * @return object ResponseObject 
     */
    public function validateField ( Array $params ) {
        
        // pr( $params );
        
        if ( $params['element'] === 'g-recaptcha-response' ) { $params['element'] = 'recaptcha';  }
        
        $element = $this->_form->getElement( $params['element'] );
        
        if ( $element instanceof Zend_Form_Element ) {
            
            if ( $element->isValid( $params['value'], $params ) ) {

                // Sends an empty response
                $this->_response->result    = 1;
                $this->_response->form      = $this->_form->getName();
                $this->_response->element   = $params['element'];
                $this->_response->messages  = [];

                
            } else {
                
                // Invalid Entry //
                
                $this->_setElementMessages( $element );

                $this->_response->result    = 0;
                $this->_response->form      = $this->_form->getName();
                $this->_response->element   = $params['element'];

            }
            
        }
        
    }

    /**
     *
     * @param Zend_Form_Element $element
     * @return \Core_Model_MessageObject
     */
    protected function _setElementMessages ( Zend_Form_Element $element ) {

        $messages = $element->getMessages();

        foreach ( $messages as $error => $message ) {

            $this->_response->messages[] = new Core_Model_MessageObject( $message, 'error', $error );

        }

    }

}
