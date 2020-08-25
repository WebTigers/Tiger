/**
 * TigerForm jQuery Plugin
 *
 * @version 1.0.04
 */

(function( $ ){

    let Class = {

        validateAjax : [],  // used to prevent duplicate calls

        init : function( oParams ) {

            $( document ).ready(function() {

                //Check for TigerDOM Library //
                if ( ! $().tigerDOM ) { alert( 'The TigerDOM plugin is required.' ); }

            });

        },

        /**
         * Intelligent Form Reset
         * @returns {*}
         */
        reset : function( ) {

            return this.each(function() {

                let type = this.type, tag = this.tagName.toLowerCase();
                if (tag === 'form') { return $(':input',this).tigerForm('reset'); }
                if (type === 'text' || type === 'password' || tag === 'textarea') { this.value = ''; }
                else if (type === 'checkbox' || type === 'radio') { this.checked = false; }
                else if (tag === 'select') { this.selectedIndex = -1; }

                Class._setElementMessage('{"element":"' + $(this).attr('name') + '"}');
                $('ul.messages').children().tigerDOM('remove');

            });

        },

        initAutoValidate : function ( ) {

            return $( 'input[data-valid]' )
                .not( 'input[type=hidden]' )
                .not( '.no-validate' ).each( function( ) {

                let $this = $(this);

                if ( $this.is('input:radio') ) { $(this).on( 'click.autovalidate', Class._ajaxValidate ); }
                else if ( $this.is('select') ) { $(this).on( 'change.autovalidate', Class._ajaxValidate ); }
                else if ( $this.is('input') ) { $this.on( 'blur.autovalidate, change.autovalidate', Class._ajaxValidate ); }

                // Set change detection so that we only validate on a changed field //
                $this.attr('data-value', $this.val() );

            });

        },

        _ajaxValidate : function ( event ) {

            let $this = $( this );

            // If we've already validated, don't validate again, this is a bad idea
            // if (  Class.validateAjax.indexOf( $this.attr('id') ) > -1 ) { return; }

            Class.validateAjax.push( $this.attr('id') );

            // If we've added the no-validate class after the init, just return.
            if ( $this.hasClass( 'no-validate' ) ) { return; }

            // Set the base post data object //
            let data = {
                module  : 'core',
                service : 'Validate',
                form    : $this.closest('form').attr('name'),
                value   : '',
                context : '',
                element : ''
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

            // Element Adjustments //
            data.element = $this.attr('name');

            function success ( data ){
                Class._setElementMessage( data );
            }

            function error ( ) {

            }

            function complete ( jqXHR, textStatus ) {
                Class.validateAjax.splice( Class.validateAjax.indexOf( $this.attr('id') ), 1 );
            }

            $.ajax({
                dataType :  'json',
                type     :  'POST',
                url      :  '/api',
                data     :  data,
                success  :  success,
                error    :  error,
                complete :  complete
            });

        },

        _setElementMessage : function ( data ) {

            // console.log( data );

            let element;
            let $element;
            let $container;
            let sId         = '';
            let sMessage    = '';
            let siClass     = '';
            let sClass      = '';
            let sError      = '';
            let sIcon       = '';
            let $form       = null;

            // parse the data object

            $.each( data, function( property, value ) {

                // console.log(property,value);

                if ( property === 'element' ) {

                    element = value;

                    $element = $( ' #' + element );

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

            let content = ( sMessage !== undefined && sMessage.length > 0 )
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

            let message = {
                content       : content,
                removeClick   : false,
                removeTimeout : ( siClass === 'success' ) ? 3000 : 0
            };

            // console.log( $container, oMessage );

            $container.tigerDOM('change', message);

        }

    };

    $.fn.tigerForm = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist.' );
        }
    };

    $().tigerForm();

})( jQuery );
