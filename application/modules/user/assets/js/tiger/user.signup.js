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
                Class._initSignupForm();

            });

        },

        // Signup Functions //

        _initSignupForm : function () {

            // Init Select2 Controls
            $( '#type_hearabout' ).select2({
                minimumResultsForSearch: -1
            });

            $('#first_name').focus();

            // if ( ! reCaptchaSignup ) {
            //     reCaptchaSignup = grecaptcha.render('reCaptchaSignup', {
            //         sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            //         callback: function (response) {
            //             oMethods.reCaptcha(response);
            //         },
            //         theme: 'dark'
            //     });
            // }

            $('#signup-button').on( 'click', Class._submitForm );

        },
        
        reCaptcha : function ( response ) {
            
            if ( response ) { 

                let data = {
                    messages: [],
                    html: null,
                    result: 0,
                    form: "Signup",
                    element: "recaptcha"
                };

                oMethods._setElementMessage( data );

            }
            
        },

        _submitForm : function ( event ) {
            
            function disableElements () {

                $('#signup').find('input, select').addClass( 'disabled' ).prop( 'disabled', true );
                $('#signup-form-processing').removeClass( 'hide' );
                $('#signup-form-arrow').addClass( 'hide' );

            }
            
            function enableElements () {

                $('#signup').find('input, select').removeClass( 'disabled' ).prop( 'disabled', false );
                $('#signup-form-processing').addClass( 'hide' );
                $('#signup-form-arrow').removeClass( 'hide' );

            }
            
            function success ( data, textStatus, jqXHR ) {
                
                // console.log( data );

                if ( parseInt( data.result, 10) === 1 ) {

                    // Signup Success //
                    
                    // User should be logged-in and sent to the Account landing page

                    window.location = '/account/dashboard';

                } else {

                    // Signup Error //
                    
                    enableElements();
                    // grecaptcha.reset( reCaptchaSignup );
                    
                    let oMessage = { 
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    };

                    $( '#form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );
                    
                    // show element error messages & flag tabs with errors
                    if ( data.form ) {

                        let msgData = {
                            form : 'Signup',
                            element : null,
                            messages : []
                        };

                        $.each(data.form, function (el, msg) {

                            msgData.element = el;

                            $.each( msg, function (errName, errMsg) {
                                msgData.messages.push( {message: errMsg, error: errName, class: "alert"} );
                            });

                            oMethods._setElementMessage( msgData );

                        });

                    }

                }

            };

            function error ( jqXHR, textStatus, errorThrown ) { 

                enableElements();
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
                method  : 'signup'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#page-signup-form').tigerForm('getFormValues', apiParams );

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                beforeSend  : disableElements,
                success     : success,
                error       : error
            });
            
        }

    };
  
    $.fn.userSignup = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().userSignup();
    
})( jQuery );
