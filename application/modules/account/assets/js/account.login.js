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
 * jQuery Tiger Account Login Plugin
 */

(function( $ ){
    
    let Class = {
        
        // Class Plugin lets //
        captcha : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initLoginForm();

            });

        },

        // Login Functions //

        _initLoginForm : function () {

            // Allow submit form from an input field if it's not empty.
            $('#page-login-form input').on( 'keyup', function( event ){
                let keycode = (event.keyCode ? event.keyCode : event.which);
                if ( parseInt(keycode, 10) === 13 && parseInt( $(this).val().length, 10 ) > 0 ) {
                    Class._submitForm();
                }
            });

            $('#login-button').on('click', Class._submitForm);
        },
        
        _submitForm : function ( event ) {

            function beforeSend () {

                /* Disable any elements if you like. */
                // $('#form_id').find('input, select').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#login-button .ajax').toggleClass( 'hide' );
                $('#login-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                // $('#form_id').find('input, select').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#login-button .ajax').toggleClass( 'hide' );
                $('#login-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {
                
                // Login Success / Error //

                if ( data.result === 1 ) {

                    if ( data.redirect ) {
                        window.location = data.redirect;
                    }
                    else {
                        window.location = '/manage';
                    }

                }
                else {

                    $('#page-login-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });
                    
                }

            }

            function error ( jqXHR, textStatus, errorThrown ) { 

                // grecaptcha.reset( reCaptchaSignup );
                
                // show general error message
                let oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#page-login-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );
                
            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'account:account',
                method  : 'login'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#page-login-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.accountLogin = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountLogin();
    
})( jQuery );
