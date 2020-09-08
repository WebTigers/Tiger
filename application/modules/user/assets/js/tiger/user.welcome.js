/**
 * jQuery Tiger User Signup Plugin
 */

(function( $ ){
    
    let Class = {
        
        // Class Plugin lets //
        captcha : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initResendForm();

            });

        },

        // Signup Functions //

        _initResendForm : function () {

            $('#resend-button').on( 'click', Class._submitForm );

        },
        
        _submitForm : function ( event ) {

            function beforeSend () {

                /* Disable any elements if you like. */
                // $('#form_id').find('input, select').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#resend-button .ajax').toggleClass( 'hide' );
                $('#resend-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                // $('#form_id').find('input, select').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#resend-button .ajax').toggleClass( 'hide' );
                $('#resend-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {
                
                // Resend Success / Error //

                $( '#page-resend-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', {
                    content       : data.html[0],
                    removeClick   : true,
                    removeTimeout : 0
                });

            }

            function error ( jqXHR, textStatus, errorThrown ) { 

                // grecaptcha.reset( reCaptchaSignup );
                
                // show general error message
                let oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );
                
            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'user:account',
                method  : 'resend'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#page-resend-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.userWelcome = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().userWelcome();
    
})( jQuery );
