<?php

class Message_Service_Template
{
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

    public function alert( $params )
    {

        // pr( $params );

        $message    = $params['message'];
        $format     = $params['format'];
        $title      = $params['title'];
        $iconCSS    = $params['icon_css'];
        $dismissible = $params['dismissible'];

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
                '<div class="flex-00-auto"> <i class="' . $iconCSS . '"></i></div>' .
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

        // pr( $params );

        $message    = $params['message'];
        $format     = $params['format'];
        $title      = $params['title'];
        $iconCSS    = $params['icon_css'];

        $timetext   = '16 hours ago';

        $template =
            '<ul class="nav-items mb-0">' .
                '<li>' .
                    '<a class="text-dark media py-2" href="javascript:void(0)">' .
                        '<div class="mr-2 ml-3">' .
                            '<i class="fa fa-fw ' . $iconCSS .' text-' . $format . '"></i>' .
                        '</div>' .
                        '<div class="media-body pr-2">' .
                            '<div class="font-w600">' . $title . '</div>' .
                            '<p class="mb-0">' . $message . '</p>' .
                            '<small class="text-muted">' . $timetext . '</small>' .
                        '</div>' .
                    '</a>' .
                '</li>' .
            '</ul>';

        return $template;
    }

}