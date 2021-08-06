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
 * Class Template
 */
class Message_Service_Template
{
    protected $translate;

    public $type = [
        'text'      => '',
        'success'   => ' alert-success',
        'alert'     => ' alert-warning',
        'danger'    => ' alert-danger',
        'info'      => ' alert-info',
        'primary'   => ' alert-primary',
        'secondary' => ' alert-secondary',
        'light'     => ' alert-light',
        'dark'      => ' alert-dark',
    ];

    public function __construct( )
    {
        $this->translate = Zend_Registry::get('Zend_Translate');
    }

    public function alert( $params )
    {

        $message        = $this->translate->translate( $params['message'] );
        $format         = $params['format'];
        $title          = $this->translate->translate( $params['title'] );
        $icon_class      = $params['icon_class'];
        $dismissible    = $params['dismissible'];

        $messageClass = "alert";
        $dismiss = '';

        $messageClass .= $this->type[ $format ];

        // Is the message template dismissable? //
        if ( intval( $dismissible ) === 1 ) {
            $dismiss = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
            $messageClass .= " alert-dismissible";
        }

        // Is there a heading? //
        if ( ! empty( $title ) ) {
            $heading = '<h3 class="alert-heading font-w300 my-2">' . $title . '</h3>';
        }

        if ( ! empty( $title ) ) {

            // Create the template with the heading message. //
            $template =
                '<div class="' . $messageClass . '" role="alert">' .
                    $dismiss .
                    $heading .
                    '<p class="mb-0">' . $message . '</p>' .
                '</div>';

            return $template;
        }
        else {

            // Current templates do have have headings with icons. //
            $template =
                '<div class="alert ' . $messageClass . ' d-flex align-items-center" role="alert">' .
                    '<div class="flex-00-auto"> <i class="' . $icon_class . '"></i></div>' .
                    '<div class="flex-fill ml-3">' .
                        $dismiss .
                       '<p class="mb-0">' . $message . '</p>' .
                    '</div>' .
                '</div>';

        }

        return $template;

    }

    public function notification ( $params )
    {
        $wrapper    = ( ! empty( $params['wrapper'] ) ) ? $params['wrapper'] : false;

        $message_id = $params['message_id'];
        $message    = $this->translate->translate( $params['message'] );
        $format     = $params['format'];
        $title      = $this->translate->translate( $params['title'] );
        $icon_class  = $params['icon_class'];
        $start_date = ( ! empty( $params['start_date'] ) ) ? Core_Service_Utility::getTimeAgo( $params['start_date'] ) : '';
        $link       = ( ! empty( $params['link'] ) ) ? $params['link'] : 'javascript:void(0)';
        $link_new   = ( intval( $params['link_new'] ) === 1 ) ? 'target="_blank"' : '';
        $dismissible = $params['dismissible'];

        $dismiss    = '';
        $messageClass = '';

        if ( intval( $dismissible ) === 1 ) {
            $dismiss = '<button type="button" class="close" data-dismiss="notification" aria-label="Close"><span aria-hidden="true">×</span></button>';
            $messageClass .= "notification-dismissible";
        }

        $template = ( $wrapper )
            ? '<ul class="nav-items mb-0">'
            : '';
        $template .=
                '<li class=" ' . $messageClass . '" data-message-id="' . $message_id . '">' .
                    '<a class="text-dark media py-2" ' . $link_new . ' href="' . $link . '">' .
                        '<div class="mr-2 ml-3">' .
                            '<i class="fa fa-fw ' . $icon_class .' text-' . $format . '"></i>' .
                        '</div>' .
                        '<div class="media-body pr-2">' .
                            $dismiss .
                            '<div class="font-w600">' . $title . '</div>' .
                            '<p class="mb-0">' . $message . '</p>' .
                            '<small class="text-muted">' . $start_date . '</small>' .
                        '</div>' .
                    '</a>' .
                '</li>';
        $template .= ( $wrapper )
            ? '</ul>'
            : '';

        return $template;
    }

}