/**
 * jQuery Tiger User Signup Plugin
 */

(function( $ ){
    
    let Class = {
        
        // Class Plugin Vars //
        captcha : null,
        validateAjax : [],

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initSignupForm();
                $().tigerForm('initAutoValidate');

            });

        },

        // Signup Functions //

        _initSignupForm : function () {
            
            // Init Select2 Rich Select Controls
            $( '#type_hearabout' ).select2({
                minimumResultsForSearch: -1
            });

            // $( '#signup #password' )
            //     .tigerForm( 'initPasswordStrength' )
            //     .tooltip({
            //         placement   : 'left',
            //         title       : $('#password-tooltip-html').html(),
            //         html        : true,
            //         trigger     : 'manual',
            //         container   : '#password-tooltip'
            //     });
            // $( '#signup #password' ).on( 'focus', function(){ $(this).tooltip('show'); $( '#signup #password' ).tigerForm( 'validatePasswordStrength' ); });
            // $( '#signup #password' ).on( 'blur', function(){ $(this).tooltip('hide'); });
            //
            // $('#signup #first_name').focus();

            // if ( ! reCaptchaSignup ) {
            //     reCaptchaSignup = grecaptcha.render('reCaptchaSignup', {
            //         sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            //         callback: function (response) {
            //             oMethods.reCaptcha(response);
            //         },
            //         theme: 'dark'
            //     });
            // }

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

        _getSignupData : function () {

            return {
                first_name      : $('#signup #first_name').val(),
                last_name       : $('#signup #last_name').val(),
                company_name    : $('#signup #company_name').val(),
                username        : $('#signup #username').val(),
                password        : $('#signup #password').val(),
                email           : $('#signup #email').val(),
                type_hearabout  : $('#signup #type_hearabout').select2('val'),
                recaptcha       : $('#signup #reCaptchaSignup .g-recaptcha-response').val(),
                service         : 'Account',
                method          : 'clientsignup',
                form            : 'Signup'
            };

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
                    grecaptcha.reset( reCaptchaSignup );
                    
                    var oMessage = { 
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
                grecaptcha.reset( reCaptchaSignup );
                
                // show general error message
                var oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );
                
            };

            // console.log( oMethods._getSignupData()  );

            $.ajax({
                type        : "POST",
                url         : "/ajax",
                dataType    : "json",
                data        : oMethods._getSignupData(),
                beforeSend  : disableElements,
                success     : success,
                error       : error
            });
            
        },

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
