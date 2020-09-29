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
 * jQuery Tiger Account Signup Plugin
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

                    window.location = '/account/welcome';

                }
                else {

                    // Signup Error //
                    
                    enableElements();
                    // grecaptcha.reset( reCaptchaSignup );

                    if ( data.html ) {

                        $('#page-signup-form .form-message')
                            .css('overflow', 'hidden')
                            .tigerDOM('insert', {
                                content: data.html[0],
                                removeClick: true,
                                removeTimeout: 0
                            });

                    }

                    // show element error messages
                    if ( data.messages ) {

                        let msgData = {
                            result : 0,
                            form : 'Account_Form_Signup',
                            element : null,
                            messages : []
                        };

                        $.each( data.messages, function ( el, msgObj ) {

                            // console.log( el, msgObj );

                            msgData.element = el;
                            msgData.messages = [];

                            $.each( msgObj, function (errName, errMsg) {
                                console.log( errName, errMsg );
                                msgData.messages.push( {message: errMsg, error: errName, class: "alert"} );
                            });

                            // console.log( msgData );

                            $().tigerForm('_setElementMessage', msgData );

                        });

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) { 

                enableElements();
                // grecaptcha.reset( reCaptchaSignup );
                
                // show general error message
                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                });
                
            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'account:account',
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
  
    $.fn.accountSignup = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountSignup();
    
})( jQuery );
