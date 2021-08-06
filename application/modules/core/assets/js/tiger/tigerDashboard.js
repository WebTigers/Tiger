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
 * jQuery TigerDashboard Plugin
 * 
 * Tiger Dashboard is a multi-function jQuery plugin that enables a little magic on the
 * admin and user management dashboards.
 * 
 * Version 2.0.0
 */

( function ( $ ) {
    
    let Class = {
        
        init : function ( ) {

            $(document).ready( function( ) {

                Class._initNotifications();

            });

        },

        _initNotifications : function( ) {

            /** Only ring the bell for about 5 or so seconds. */
            if ( $('#page-header-notifications-dropdown span.badge-pill').length > 0 ) {
                setTimeout( function (){
                    $('#page-header-notifications-dropdown i').removeClass('ringing');
                },9000 );
            }

            $('body').on('click.notification-dismiss', 'div.media-body button[data-dismiss="notification"]', function ( event ) {
                event.preventDefault();
                event.stopPropagation();
                Class._updateNotification( $(this).closest('li').attr('data-message-id') );
            });

        },

        _updateNotification ( message_id ) {

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( parseInt( data.result, 10 ) === 1 ) {

                    $('li[data-message-id="' + data.data.message_id + '"]').tigerDOM('remove');

                }
                else {

                    $( '#page-messages' ).css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                $( '#page-messages' ).css('overflow', 'hidden').tigerDOM('change', {
                        content: '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                        removeClick: true,
                        removeTimeout: 0
                    });

            }

            let data = {
                service     : 'message:notification',
                method      : 'dismiss',
                message_id  : message_id
            };

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                beforeSend  : beforeSend,
                complete    : complete,
                success     : success,
                error       : error
            });

        }

    };
  
    $.fn.tigerDashboard = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.tigerDOM' );
        }    
    };
    
    $().tigerDashboard();

} ) ( jQuery );