/**
 * TigerForm jQuery Plugin
 *
 * TigerForm is a convenience from plugin to marshal form vars
 * and do auto-validation.
 *
 * @version 2.0.0
 */

(function( $ ){

    let Class = {

        validateAjax : [],  // used to prevent duplicate calls

        init : function( oParams ) {

            $( document ).ready(function() {

                //Check for TigerDOM Library //
                if ( ! $().tigerDOM ) { alert( 'The TigerDOM plugin is required.' ); }

                Class.initAutoValidate();

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

        /**
         * A convenience method used to return a JSON
         * compatible array of the form's values.
         * @param object | null params that will be added to the form values.
         * @returns object
         */
        getFormValues : function ( formValues ) {

            if ( formValues === undefined ) {
                formValues = {};
            }

            if ( $(this).is('form') ) {
                $( $(this).serializeArray() ).each(function ( i, el ) {
                    formValues[el.name] = el.value;
                });
            }

            return formValues;

        },

        initAutoValidate : function ( ) {

            return $( 'input[data-valid], select[data-valid]' )
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

            Class.validateAjax.push( $this.attr('id') );

            // If we've added the no-validate class after the init, just return.
            if ( $this.hasClass( 'no-validate' ) ) { return; }

            // Set the base post data object //
            let data = {
                service : 'core:validate',
                method  : 'element',
                form    : $this.closest('form').attr('name'),
                element : $this.attr('name'),
                value   : '',
                context : ''
            };

            let $form = $('form[name="' + data.form + '"]');

            // Set the element value //
            data.value = $this.val();

            // Override the element value for special input elements like checkboxes and radio buttons //
            if ( $this.is(':radio') && $( 'input:radio[name=' + $this.attr('name') + ']' ).is(':checked') ) {
                data.value = $this.val();
            }
            if ( $this.is(':checkbox') ) {
                data.value = ( $this.is(':checked' ) ) ? $this.val() : '';
            }

            // If the element value and data.value are the same, then no change has occurred, just return.
            if ( parseInt( $this.attr( 'data-valid' ), 10 ) === 1 &&
                $this.attr( 'data-value' ) === data.value ) { return; }

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

            let $element = $('form[name="' + data.form + '"] #' + data.element );

            if ( data.result === 0 ) {

                let content = '<div id="' + data.element + '-error" class="invalid-feedback">' + data.messages[0].message + '</div>';
                $element.closest('div.form-group').find('.message-container').tigerDOM('change', { content : content } );
                $element.addClass('is-invalid');

            }
            else {

                $element.closest('div.form-group').find('.message-container').tigerDOM('change', { content : '' } );
                $element.removeClass( 'is-invalid' ).addClass('is-valid');

            }

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
