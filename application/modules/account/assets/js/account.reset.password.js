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
 * jQuery Tiger Rest Password Plugin
 */

(function( $ ){
    
    let Class = {

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //

                $('#modal-password-reset-form').modal('show');

                $('#save-password-button').on('click', Class.save );

            });

        },

        // Admin Functions //

        save : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#modal-password-reset-form i.icon').addClass('hide');
                $('#modal-password-reset-form i.ajax').removeClass('hide');
                $('#modal-password-reset-form button').prop('disabled', true);
            }

            function complete ( jqXHR, textStatus ) {
                $('#modal-password-reset-form i.icon').removeClass('hide');
                $('#modal-password-reset-form i.ajax').addClass('hide');
                $('#modal-password-reset-form button').prop('disabled', false);
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.confirm = null;
                    $('#modal-password-reset-form').modal('hide');
                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }
                else {

                    /** Oops, something went wrong ... */

                    if ( data.html ) {

                        $( '#form-setup-message' ).css('overflow','hidden').tigerDOM( 'change', {
                            content       : data.html[0],
                            removeClick   : true,
                            removeTimeout : 0
                        });

                    }

                    /** show element error messages */
                    if ( data.messages ) {

                        let msgData = {
                            result : 0,
                            form : 'Core_Form_Setup',
                            element : null,
                            messages : []
                        };

                        $.each( data.messages, function ( el, msgObj ) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each( msgObj, function (errName, errMsg) {
                                msgData.messages.push( {message: errMsg, error: errName, class: "alert"} );
                            });

                            $().tigerForm('_setElementMessage', msgData );

                        });

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-setup-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'account:account',
                method  : 'password',
            };

            /** Note that our API params will be added to the form data */
            let data = $('#password-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.accountResetPassword = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountResetPassword();
    
})( jQuery );
