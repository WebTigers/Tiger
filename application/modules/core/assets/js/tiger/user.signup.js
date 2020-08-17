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


            });

        },

        // Signup Functions //

        _initSignupForm : function () {
            
            // Init Select2 Rich Select Controls
            $('[data-plugin-selectTwo]').each( function () {
                $( this ).attr('data-value', $( this ).val() ); // value change detection
                $( this ).select2({minimumResultsForSearch:-1}).on('change, select2-blur',function( event ){
                    $( event.target ).tigerForm( '_ajaxValidate' );
                });
            });

            $( '#signup #password' )
                .tigerForm( 'initPasswordStrength' )
                .tooltip({
                    placement   : 'left',
                    title       : $('#password-tooltip-html').html(),
                    html        : true,
                    trigger     : 'manual',
                    container   : '#password-tooltip'
                });
            $( '#signup #password' ).on( 'focus', function(){ $(this).tooltip('show'); $( '#signup #password' ).tigerForm( 'validatePasswordStrength' ); });
            $( '#signup #password' ).on( 'blur', function(){ $(this).tooltip('hide'); });

            $('#signup #first_name').focus();

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

        // Ajax Validation //

        _initAutoValidate : function () {

            $( '#signup' )
                .find( 'input[data-valid]' )
                .not( 'input[type=hidden]' )
                .not( '.no-validate' ).each( function( ) {

                var $this = $(this);

                $this.on( 'blur.autovalidate, change.autovalidate', oMethods._ajaxValidate );

                if ( $this.is('input:radio') ) { $(this).bind('click.autovalidate', oMethods._ajaxValidate); }

                // Set change detection so that we only validate on a changed field //
                $this.attr('data-value', $this.val() );

            });


        },

        _ajaxValidate : function ( event ) {

            // console.log( [event, this] );

            var $this = $( this );

            if (  oMethods.validateAjax.indexOf( $this.attr('id') ) > -1 ) { return; }

            oMethods.validateAjax.push( $this.attr('id') );

            // If we've added the no-validate class after the init, just return.
            if ( $this.hasClass( 'no-validate' ) ) { return; }

            // Set the base post data object //
            var data = {
                service : 'Validate',
                form    : $this.closest('form').attr('name'),
                value   : '',
                context : '',
                element : '',
                persist : ''
            };

            // Set the element name and value //
            data.element = $this.attr('name');
            data.value = ( $this.is('input:radio') )
                ? ($( 'input:radio[name=' + $this.attr('name') + ']' ).is(':checked'))
                    ? $this.val()
                    : ''
                : $this.val();

            // If the element value and data.value are the same, then no change has occured, just return.
            if ( parseInt( $this.attr( 'data-valid' ), 10 ) === 1 && $this.attr( 'data-value' ) === data.value ) { return; }

            // Make the AJAX call //
            $.ajax({
                dataType :  'json',
                type     :  'POST',
                url      :  '/ajax',
                data     :  data,
                success  :  oMethods._setElementMessage,
                complete :  function( jqXHR, textStatus ) {
                                oMethods.validateAjax.splice( oMethods.validateAjax.indexOf( $this.attr('id') ), 1 );
                            }
            });

        },

        _setElementMessage : function ( data ) {

            // console.log( data );

            if ( data.element === 'recaptcha' ){ data.element = 'reCaptchaSignup'; }

            let errorMessage = null;
            let oMessage;
            let $element = $('form[name="' + data.form + '"] #' + data.element);
            let $messageContainer = $element.closest('div.form-group').find('div.field-message');

            // Get the message string
            $.each( data.messages, function( i, msg ) {
                errorMessage = msg;
                return false;
            });

            // console.log( errorMessage, $element, $messageContainer );

            if ( errorMessage ) {

                $element.attr( 'data-valid', '0' );

                oMessage = {
                    content       : '<div class="alert"><i class="fa fa-warning"> </i>' + errorMessage.message + '</div>',
                    removeClick   : false,
                    removeTimeout : 0
                };

                $element.closest('.form-group').addClass('has-warning');
                $element.closest('.form-group').removeClass('has-success');
                $messageContainer.tigerDOM('change', oMessage);

            } else {

                $element.closest('.form-group').removeClass('has-warning');
                $element.closest('.form-group').addClass('has-success');
                $element.attr( 'data-valid', '1' );
                $messageContainer.children().tigerDOM('remove');

            }

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
