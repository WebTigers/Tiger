/**
 * TigerForm jQuery Plugin for NewLIST
 * 
 * @version 1.0.04
 * 
 * 1.0.4 Added div.text element to hints
 * 1.0.3 Fixed bug to initialize non-visible fields
 * 1.0.2 Added Form Reset Feature
 *       Fixed a number of bugs related to radio and checkbox controls
 * 1.0.1 Form Tweaks
 * 1.0.0 Initial version
 */

(function( $ ){

    var oClass = {

        password : {},
        validateAjax : [],  // used to prevent duplicate calls

        // methods //
        init : function( oParams ) {

            $( document ).ready(function() {
                
                //Check for TigerDOM Library //
                if ( ! $().tigerDOM ) { alert( 'The jQuery TigerDOM plugin is required.' ); }

            });

        },
        
        destroy : function( ) {
            
        },

        setParams : function ( oParams ) {
            
            $.each(oParams, function( property, value ) {
                oClass[property] = value;
            });

        },
        
        reset : function( ) {
          
          // Adds an intelligent form reset function
          
          return this.each(function() {

                var type = this.type, tag = this.tagName.toLowerCase();
                if (tag === 'form') { return $(':input',this).tigerForm('reset'); }
                if (type === 'text' || type === 'password' || tag === 'textarea') { this.value = ''; }
                else if (type === 'checkbox' || type === 'radio') { this.checked = false; }
                else if (tag === 'select') { this.selectedIndex = -1; }
            
                oClass._setElementMessage('{"element":"' + $(this).attr('name') + '"}');            
                $('ul.messages').children().tigerDOM('remove');
                
              });
            
        },
        
        reCaptchaSignin : function ( response ) {
            
            // console.log('reCaptchaSignin', response );
            
        },

        reCaptchaRecover : function ( response ) {
            
            // console.log('reCaptchaRecover', response );
            
        },

        initPasswordStrength : function( ) {

            return this.each( function(){
                
                var $element = $(this);

                // Get password requirments from our form element
                // oClass.password = $.parseJSON( $('#password').attr('data-requirements') );
                if ( $element.attr('data-requirements') ) {
                    oClass.password = $.parseJSON($element.attr('data-requirements'));
                    $element.on('keyup.passwordStrength', oClass.validatePasswordStrength );
                }

            });
        
        },
        
        validatePasswordStrength : function ( ) {

            var $form = $( this ).closest( 'form' );
            var password = $( this ).val();

            // Sets icons based on the hidden password-requirements element
            
            /* This is something of what the oClass.password object looks like:
            
                digit: "1"
                digit_value: "5"
                illegal: "/^[\S\C]+$/"
                labels: Array[4]
                    0: "Weak"
                    1: "Fair"
                    2: "Good"
                    3: "Strong"
                length: "10"
                length_value: "3"
                lower: "1"
                lower_value: "5"
                repeating: "3"
                special: "1"
                special_value: "10"
                strength: "70"
                threshhold: Object
                    0: "30"
                    1: "40"
                    2: "50"
                    3: "70"
                upper: "1"
                upper_value: "5"
            */            
            
            function setClass ( selector, status ) {
                
                var $element = $( selector );
                
                if ( status === true ) {
                    
                    if ( $element.hasClass( 'red' ) ) {
                        $element.removeClass( 'fa-ban red' ).addClass( 'fa-check green' );
                    }
                    
                } else {
                    
                    if ( $element.hasClass( 'green' ) ) {
                        $element.removeClass( 'fa-check green' ).addClass( 'fa-ban red' );
                    }
                    
                }
                
            }
            
            function setColor ( value ) {
                
                var red         = 255;  //i.e. FF
                var green       = 0;
                var stepSize    = parseInt( 2.5 * value);
                
                green += stepSize;
                if (green > 255) { green = 255; }
                red -= stepSize;
                if (red < 0) { red = 0; }

                $form.find( '#progress-password-strength' ).css( 'background-color', 'rgb('+ red + ',' + green + ',0)' );
                
            }
            
            var strength = 0;
            var count    = 0;
            var re       = null;
            
            // Length
            oClass.password.length_value = parseInt( oClass.password.length_value, 10 )
            strength = password.length * oClass.password.length_value;
            setClass( '.icon-password-length', ( password.length >= oClass.password.length ) ); 

            // Lowercase
            oClass.password.lower = parseInt( oClass.password.lower, 10 );
            oClass.password.lower_value = parseInt( oClass.password.lower_value, 10 );
            count = $( password.match(/[a-z]/g) ).length;
            setClass( '.icon-password-lower', ( count >=  oClass.password.lower) ); 
            strength += ( count ) ? count * parseInt( oClass.password.lower_value, 10 ) : 0;

            // Uppercase
            oClass.password.upper = parseInt( oClass.password.upper, 10 )
            count = $( password.match(/[A-Z]/g) ).length;
            setClass( '.icon-password-upper', ( count >= oClass.password.upper ) ); 
            strength += ( count ) ? count * parseInt( oClass.password.upper_value, 10 ) : 0;

            // Digit
            oClass.password.digit = parseInt( oClass.password.digit, 10);
            count = $( password.match(/[\d]/g) ).length;
            setClass( '.icon-password-digit', ( count >= oClass.password.digit ) ); 
            strength += ( count ) ? count * parseInt( oClass.password.digit_value, 10 ) : 0;

            // Special
            oClass.password.special = parseInt( oClass.password.special, 10);
            count = $( password.match(/[\W]/g) ).length;
            setClass( '.icon-password-special', ( count >= oClass.password.special ) ); 
            strength += ( count ) ? count * parseInt( oClass.password.special_value, 10 ) : 0;

            // Repeating
            oClass.password.repeating = parseInt( oClass.password.repeating, 10 );
            re = new RegExp( '(.)\\1{' + ( oClass.password.repeating ) + '}','g');
            count = $( password.match( re ) ).length;
            setClass( '.icon-password-repeating', ( count === 0 ) ); 

            // Illegal
            count = $( password.match(/\s/g) ).length;
            setClass( '.icon-password-illegal', ( count === 0 ) );
            
            // Strength
            oClass.password.strength = parseInt( oClass.password.strength, 10 );
            setClass( '.icon-password-strength', ( strength >= oClass.password.strength ) );
            strength = ( strength > 100 ) ? 100 : strength;
            $form.find( '#progress-password-strength' ).css('width', strength + '%');
            setColor( strength );

            // console.log( $('#progress_password_strength').length );
            
        },

        _initAutoValidate : function ( ) {

            return $(this).each( function( ) {
                
                var $this = $(this);
                
                $this.on( 'blur.autovalidate, change.autovalidate', oClass._ajaxValidate );
                
                if ( $this.is('input:radio') ) { $(this).bind('click.autovalidate', oClass._ajaxValidate); }
                // if ( $this.is('select')      ) { $(this).bind('change.autovalidate', oClass._ajaxValidate); }
                
                // Set change detection so that we only validate on a changed field //
                $this.attr('data-value', $this.val() );
                
            });           
            
        },
        
        _ajaxValidate : function ( event ) {

            // console.log( [event, this] );

            var $this = $( this );

            // If we've already validated, don't validate again, this is a bad idea
            // if (  oClass.validateAjax.indexOf( $this.attr('id') ) > -1 ) { return; }

            oClass.validateAjax.push( $this.attr('id') );

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

            // Set the element value //
            data.value = ( $this.is('input:radio') ) 
                ? ($( 'input:radio[name=' + $this.attr('name') + ']' ).is(':checked')) 
                    ? $this.val()
                    : '' 
                : $this.val();

            // If the element value and data.value are the same, 
            // then no change has occured, just return.
            if ( parseInt( $this.attr( 'data-valid' ), 10 ) === 1 && 
                    $this.attr( 'data-value' ) === data.value ) { return; }

            // Contact_Value, set the context //
            if ( $this.attr('name') === 'contact_value' ) { 
                data.context = 
                    ( $this.closest('form').attr( 'id' ) === 'user-contact-form' ) 
                    ? 'user' : 'org'; 
            }

            // Element Adjustments //
            data.element = $this.attr('name');

            if ( data.form === 'Contact' ) {
                data.contact_id = $this.attr( 'data-contact_id' );
            }
            
            if ( data.form === 'Address' ) {
                data.address_id = $( '#address_id' ).val();
            }

            if ( data.create_date && moment( data.create_date, 'DD-MMM-YYYY' ) ) {
                data.create_date = moment( data.create_date, 'DD-MMM-YYYY' ).format('YYYY-MM-DD');
            }

            // This date grooming needs better targeting
            if ( moment( data.value, 'DD-MMM-YYYY').isValid() ) {
                // data.value = moment( data.value, 'DD-MMM-YYYY' ).format('YYYY-MM-DD');
            }

            // Attempt to persist data after validation
            data.persist = ( $this.attr( 'data-persist' ) !== undefined ) 
                    ? $this.attr( 'data-persist' ) 
                    : '';

            // Make the AJAX call //
            $.ajax({
                dataType :  'json',
                type     :  'POST',
                url      :  '/ajax',
                data     :  data,
                success  :  oClass._setElementMessage,
                complete :  function( jqXHR, textStatus ) {
                                oClass.validateAjax.splice( oClass.validateAjax.indexOf( $this.attr('id') ), 1 );
                            }
            });           
            
        },
        
        _setElementMessage : function ( data ) {
            
            // console.log( data );
            
            var element;
            var $element;
            var $container;
            var sId         = '';
            var sMessage    = '';
            var siClass     = '';
            var sClass      = '';
            var sError      = '';
            var sIcon       = '';
            var $form       = null;
            
            // parse the data object
            
            $.each( data, function( property, value ) {
                
                // console.log(property,value);
                
                if ( property === 'element' ) { 

                    element = value;
                    
                    $element = $('form#' + data.form + ' #' + element );
                    if ( $element.length === 0 ) {
                        $element = $('form[name="' + data.form + '"] #' + element );
                    }

                    // console.log( $element );

                    // $element = ( $('[name=' + element + ']').is(':radio') ) ? $('[name=' + element + ']') : $('#' + element);
                    
                } 

                else if ( property === 'messages' ) {
                    
                    $.each( value, function( i, msgObj ) {
        
                        sMessage = ( typeof msgObj === "string" ) ? msgObj  : msgObj.message;
                        siClass  = ( typeof msgObj === "string" ) ? ''      : msgObj.class;
                        sError   = ( typeof msgObj === "string" ) ? ''      : msgObj.error;
                        
                    });
                    
                }
                
                else if ( property === 'id' ) {

                    sId = value;

                }

            });
            
            if ( element === 'type_contact' || element === 'contact_value' ) { 
                $element = $( '[name=' + element + '][data-contact_id=' + sId + ']' ); 
            }

            $container = $element.closest('div.form-group').find('.field-message');

            switch ( siClass ) {

                case 'info':
                    sClass  = 'alert alert-info';
                    sIcon   = 'fa fa-info-circle';
                    break;

                case 'success':
                    sClass  = 'alert alert-success';
                    sIcon   = 'fa fa-check';
                    break;

                case 'error':
                    sClass  = 'alert alert-danger';
                    sIcon   = 'fa fa-ban';
                    break;

                case 'alert':
                default :
                    sClass  = 'alert alert-warning';
                    sIcon   = 'fa fa-warning';
                    break;
            }

            var content = ( sMessage !== undefined && sMessage.length > 0 )
                ? '<div class="alert ' + sClass + '"><i class="' + sIcon + '"> </i>' + sMessage + '</div>'
                : '';

            if ( content === '' || siClass === 'success' ) {
                $element.closest('.form-group').removeClass('has-warning');
                $element.closest('.form-group').addClass('has-success');
            }
            else {
                $element.closest('.form-group').removeClass('has-success');
                $element.closest('.form-group').addClass('has-warning');
            }

            $element.attr( 'data-valid', ( content === '' || siClass === 'success' ) ? 1 : 0 ); 
            
            if ( parseInt( $element.attr( 'data-valid' ) ) === 1 ) {

                if ( $element.is('select') ) {
                    $element.attr('data-value', $element.find(':selected').val() );
                } else {
                    $element.attr('data-value', $element.val() );
                }

            }

            var oMessage = { 
                content       : content,
                removeClick   : false,
                removeTimeout : ( siClass === 'success' ) ? 3000 : 0
            };

            // console.log( $container, oMessage );

            $container.tigerDOM('change', oMessage);
                
        }
	
    };
  
    $.fn.tigerForm = function( method ) {
        if ( oClass[method] ) {
            return oClass[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return oClass.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist.' );
        }    
    };
    
    $().tigerForm();

})( jQuery );

var reCaptchaMenuSignin;
var reCaptchaMenuRecover;
var reCaptchaSignup;
var reCaptchaLogin;
var reCaptchaSubscriber;
var reCaptchaContactLocation;
var reCaptchaRecover;
var reCaptchaContact;
var reCaptchaModalLogin;
var reCaptchaModalSignup;

// Google reCaptcha
function reCaptchaOnload(){

    if ( $('#reCaptchaMenuSignin').length > 0 ) {
        reCaptchaMenuSignin = grecaptcha.render('reCaptchaMenuSignin', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().tigerForm('reCaptchaSignin',response); },
            theme: 'dark'
        });
    }
    
    if ( $('#reCaptchaMenuRecover').length > 0 ) {
        reCaptchaMenuRecover = grecaptcha.render('reCaptchaMenuRecover', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().tigerForm('reCaptchaRecover',response); },
            theme: 'dark'
        });
    }

    if ( $('#reCaptchaSignup').length > 0 ) {
        reCaptchaSignup = grecaptcha.render('reCaptchaSignup', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            callback: function( response ){ jQuery().newListSignup('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
    if ( $('#reCaptchaLogin').length > 0 ) {
        reCaptchaLogin = grecaptcha.render('reCaptchaLogin', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListLogin('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
    // if ( $('#reCaptchaSubscriber').length > 0 ) {
    //     reCaptchaSubscriber = grecaptcha.render('reCaptchaSubscriber', {
    //         sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
    //         // callback: function( response ){ jQuery().newListRecover('reCaptcha',response); },
    //         theme: 'dark'
    //     });
    // }
    
    if ( $('#reCaptchaContactLocation').length > 0 ) {
        reCaptchaContactLocation = grecaptcha.render('reCaptchaContactLocation', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListRecover('reCaptcha',response); },
            theme: 'dark'
        });
    }

    if ( $('#reCaptchaRecover').length > 0 ) {
        reCaptchaRecover = grecaptcha.render('reCaptchaRecover', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListRecover('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
    if ( $('#reCaptchaContact').length > 0 ) {
        reCaptchaContact = grecaptcha.render('reCaptchaContact', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListRecover('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
    if ( $('#reCaptchaUnsubscribe').length > 0 ) {
        reCaptchaUnsubscribe = grecaptcha.render('reCaptchaUnsubscribe', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListRecover('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
    if ( $('#reCaptchaModalSignup').length > 0 ) {
        reCaptchaModalSignup = grecaptcha.render('reCaptchaModalSignup', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListSignup('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
    if ( $('#reCaptchaModalLogin').length > 0 ) {
        reCaptchaModalLogin = grecaptcha.render('reCaptchaModalLogin', {
            sitekey: '6LcuQCUTAAAAAP902FnRTgy2p0Ve8JYWNW1jWlPt',
            // callback: function( response ){ jQuery().newListLogin('reCaptcha',response); },
            theme: 'dark'
        });
    }
    
}
