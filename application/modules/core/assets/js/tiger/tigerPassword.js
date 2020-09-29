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
 * Tiger Password Strength jQuery Plugin
 *
 * A convenience plugin used to show relative password strength. This plugin has a
 * number of moving parts and requires the Tiger_Validate_Strength library component,
 * password.ini, and the translated HTML template. See the Tiger docs for usage.
 *
 * @version 2.0.0
 */

(function( $ ){

    let Class = {

        init : function( oParams ) {

            $( document ).ready(function() {

                //Check for TigerDOM Library //
                if ( ! $().tigerDOM ) { alert( 'The TigerDOM plugin is required.' ); }

                $( '.tiger-password-strength' )
                    .tigerPassword( 'initPasswordStrength' );

            });

        },

        initPasswordStrength : function( ) {

            return this.each( function(){

                let $element = $(this);

                // Allow the element to be switched between text and password to show/hide the value.
                $element.on('dblclick', function ( ) {
                    $(this).attr('type', function(index, attr){
                        return (attr === 'text') ? 'password' : 'text';
                    });
                });

                // Get password requirements from our form element
                if ( $element.attr('data-requirements') ) {

                    Class.password = $.parseJSON($element.attr('data-requirements'));

                    $element.on('focus.passwordStrength', function (){
                        $(this).closest('div.form-group').find('.password-html').tigerDOM('open');
                    });

                    $element.on('blur.passwordStrength', function (){
                        $(this).closest('div.form-group').find('.password-html').tigerDOM('close');
                    });

                    $element.on('keyup.passwordStrength', Class.validatePasswordStrength );

                }

                // Set values //
                let $container = $( this ).closest( 'div.form-group' );
                if ( Class.password.strength > 0 ) {
                    $container.find('.pw-strength-count').html( Class.password.strength );
                }
                else {
                    $container.find('.pw-strength').hide();
                }

                if ( Class.password.length > 0 ) {
                    $container.find('.pw-length-count').html( Class.password.length );
                }
                else {
                    $container.find('.pw-length').hide();
                }

                if ( Class.password.lower > 0 ) {
                    $container.find('.pw-llower-count').html( Class.password.lower );
                }
                else {
                    $container.find('.pw-lower').hide();
                }

                if ( Class.password.upper > 0 ) {
                    $container.find('.pw-upper-count').html( Class.password.upper );
                }
                else {
                    $container.find('.pw-upper').hide();
                }

                if ( Class.password.digit > 0 ) {
                    $container.find('.pw-digit-count').html( Class.password.digit );
                }
                else {
                    $container.find('.pw-digit').hide();
                }

                if ( Class.password.special > 0 ) {
                    $container.find('.pw-special-count').html( Class.password.special );
                }
                else {
                    $container.find('.pw-special').hide();
                }

                if ( Class.password.repeating > 0 ) {
                    $container.find('.pw-repeating-count').html( Class.password.repeating );
                }
                else {
                    $container.find('.pw-repeating').hide();
                }

            });

        },

        validatePasswordStrength : function ( ) {

            let $form = $( this ).closest( 'form' );
            let password = $( this ).val();

            // Sets icons based on the hidden password-requirements element

            /* This is something of what the Class.password object looks like:

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

                let $element = $( selector );

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

                let red         = 255;  //i.e. FF
                let green       = 0;
                let stepSize    = parseInt( 2.5 * value);

                green += stepSize;
                if (green > 255) { green = 255; }
                red -= stepSize;
                if (red < 0) { red = 0; }

                $form.find( '.progress-bar' ).css( 'background-color', 'rgb('+ red + ',' + green + ',0)' );

            }

            let strength = 0;
            let count    = 0;
            let re       = null;

            // Length
            Class.password.length_value = parseInt( Class.password.length_value, 10 )
            strength = password.length * Class.password.length_value;
            setClass( '.icon-password-length', ( password.length >= Class.password.length ) );

            // Lowercase
            Class.password.lower = parseInt( Class.password.lower, 10 );
            Class.password.lower_value = parseInt( Class.password.lower_value, 10 );
            count = $( password.match(/[a-z]/g) ).length;
            setClass( '.icon-password-lower', ( count >=  Class.password.lower) );
            strength += ( count ) ? count * parseInt( Class.password.lower_value, 10 ) : 0;

            // Uppercase
            Class.password.upper = parseInt( Class.password.upper, 10 )
            count = $( password.match(/[A-Z]/g) ).length;
            setClass( '.icon-password-upper', ( count >= Class.password.upper ) );
            strength += ( count ) ? count * parseInt( Class.password.upper_value, 10 ) : 0;

            // Digit
            Class.password.digit = parseInt( Class.password.digit, 10);
            count = $( password.match(/[\d]/g) ).length;
            setClass( '.icon-password-digit', ( count >= Class.password.digit ) );
            strength += ( count ) ? count * parseInt( Class.password.digit_value, 10 ) : 0;

            // Special
            Class.password.special = parseInt( Class.password.special, 10);
            count = $( password.match(/[\W]/g) ).length;
            setClass( '.icon-password-special', ( count >= Class.password.special ) );
            strength += ( count ) ? count * parseInt( Class.password.special_value, 10 ) : 0;

            // Repeating
            Class.password.repeating = parseInt( Class.password.repeating, 10 );
            re = new RegExp( '(.)\\1{' + ( Class.password.repeating ) + '}','g');
            count = $( password.match( re ) ).length;
            setClass( '.icon-password-repeating', ( count === 0 ) );

            // Illegal
            count = $( password.match(/\s/g) ).length;
            setClass( '.icon-password-illegal', ( count === 0 ) );

            // Strength
            if ( Class.password.strength > 0 ) {
                Class.password.strength = parseInt(Class.password.strength, 10);
                setClass('.icon-password-strength', (strength >= Class.password.strength));
                strength = (strength > 100) ? 100 : strength;
                $form.find('.progress-bar').css('width', strength + '%');
                $form.find('.progress-bar-tooltip').html(strength);
                setColor(strength);
            }

        }

    };

    $.fn.tigerPassword = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist.' );
        }
    };

    $().tigerPassword();

})( jQuery );
