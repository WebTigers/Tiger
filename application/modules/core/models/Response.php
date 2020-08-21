<?php

class Core_Model_Response
{
    /**
     * Result
     *
     * Often the result is simply an boolean or integer response.
     *
     * @var mixed
     */
    public $result;

    /**
     * Used for any type of response data to be consumed by the call.
     *
     * @var mixed
     */
    public $data;

    /**
     * Used for form validation messages.
     *
     * @var array
     */
    public $form;

    /**
     * Response text
     * 
     * @var array of text strings
     */
    public $text = [];
    
    /**
     * Response HTML strings
     * 
     * @var string
     */
    public $html = [];

    /**
     * Response login tells us if we need to login again. This value is set
     * with (user_role === "guest"). If it is true, then a new login is needed.
     *
     * @var bool
     */
    public $login = false;

    /**
     *
     * @var translate
     */
    protected $_translate;

    public function __construct() {
        
        $this->_translate = Zend_Registry::get( 'Zend_Translate' );
        
    }

    public function setTextMessage( $message, $type = 3 )
    {

        $this->_text[] = $message;
        $this->createHTMLMessage( $message, $type );

    }

    /**
     *
     * @param mixed $message object or sting
     * @param mixed $type (see switch statement for types)
     * @return string '<div class="alert alert-info"><i class="fa fa-info-circle"></i> &nbsp;Some translated message.</div>'
     */
    public function createHTMLMessage ( $message, $type = 3 ) {
        
        $out_message    = ( is_object( $message ) ) ? $message->message : $message;
        $out_type       = ( is_object( $message ) ) ? $message->class   : $type;

        switch ( $out_type ) {
            
            case 3:
            case 'alert':
                $class = 'alert alert-warning';
                $icon  = 'fa fa-fw fa-warning';
                break;

            case 2:
            case 'error':
                $class = 'alert alert-danger';
                $icon  = 'fa fa-fw fa-ban';
                break;

            case 1:
            case 'success':
                $class = 'alert alert-success';
                $icon  = 'fa fa-fw fa-check';
                break;
            
            case 0:
            case 'info':
            default :
                $class = 'alert alert-info';
                $icon  = 'fa fa-fw fa-info-circle';
                break;
            
        }

        /**
         * The HTML Message template.
         * @todo: Create a way to add additional templates for different themes.
         *
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <div class="flex-00-auto">
                <i class="fa fa-fw fa-exclamation-circle"></i>
            </div>
            <div class="flex-fill mr-3">
               <p class="mb-0">This is a warning message!</p>
            </div>
        </div>
        */

        return  '<div class="' . $class . ' d-flex align-items-center">'.
                    '<div class="flex-00-auto">' .
                        '<i class="' . $icon . '"></i>' .
                    '</div>' .
                    '<div class="flex-fill mr-3">' .
                        $this->_translate->_( $out_message ) .
                    '</div>' .
                '</div>';
        
    }

    /**
     * Returns an array of the public response properties.
     * @return array
     */
    public function toArray()
    {
        return [
            'result'    => $this->result,
            'data'      => $this->data,
            'form'      => $this->form,
            'text'      => $this->text,
            'html'      => $this->html,
            'login'     => $this->login,
        ];
    }
    
}
