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

class Core_Model_ResponseObject
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
     * Used for form validation.
     *
     * @var array
     */
    public $form;

    /**
     * Used for form validation element identity
     *
     * @var string
     */
    public $element;

    /**
     * Used for form validation form or element messages
     * @var array
     */
    public $messages;

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
     * Response redirect
     *
     * @var null
     */
    public $redirect = null;

    /**
     * Response login tells us if we need to login again. This value is set
     * with (user_role === "guest"). If it is true, then a new login is needed.
     *
     * @var bool
     */
    public $login = false;

    const MESSAGE_CLASS_ALERT = 3;
    const MESSAGE_CLASS_ERROR = 2;
    const MESSAGE_CLASS_SUCCESS = 1;
    const MESSAGE_CLASS_INFO = 0;

    public function __construct( array $params = [] )
    {
        foreach ( $params as $key => $value) {
            $this->$key = $value;
        }
    }

    public function setTextMessage( $message, $type = 3 )
    {

        $this->text[] = $message;
        $this->html[] = $this->createHTMLMessage( $message, $type );

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
                $icon  = 'fa fa-fw fa-exclamation-triangle';
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

        return  '<div class="' . $class . ' d-flex align-items-left">'.
                    '<div class="flex-00-auto">' .
                        '<i class="' . $icon . '"></i>' .
                    '</div>' .
                    '<div class="flex-fill mr-3">' .
                        Zend_Registry::get( 'Zend_Translate' )->translate( $out_message ) .
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
            'element'   => $this->element,
            'messages'  => $this->messages,
            'text'      => $this->text,
            'html'      => $this->html,
            'login'     => $this->login,
            'redirect'  => $this->redirect,
        ];
    }
    
}
