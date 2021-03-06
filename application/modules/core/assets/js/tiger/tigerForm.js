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
 * TigerForm jQuery Plugin
 *
 * TigerForm is a convenience from plugin to marshal form vars and do auto-validation.
 *
 * @version 2.0.0
 */

(function( $ ){

    let Class = {

        validateAjax : [],  // used to prevent duplicate calls
        persistAjax : [],

        init : function( oParams ) {

            $( document ).ready(function() {

                //Check for TigerDOM Library //
                if ( ! $().tigerDOM ) { alert( 'The TigerDOM plugin is required.' ); }

                Class.initAutoValidate();
                Class.initAutoPersist();
                Class.initBlockOptions();

            });

        },

        /**
         * Intelligent Form Reset
         * @returns {*}
         */
        reset : function( exclude ) {

            let boilerPlateVars = [
                'email_validate_key',
                'password_reset_key',
                'create_user_id',
                'update_user_id',
                'create_date',
                'update_date',
                'create_ip',
                'update_ip'
            ];

            let $form = $(this);

            this.each(function() {

                if ( exclude && exclude.indexOf( this.id ) > -1 ){ return false; }

                let type = this.type, tag = this.tagName.toLowerCase();

                if (tag === 'form') {
                    return $(':input',this).tigerForm('reset');
                }

                if (type === 'text' || type === 'password' || tag === 'textarea') {
                    this.value = '';
                }
                else if (type === 'checkbox' || type === 'radio') {
                    this.checked = false;
                }
                else if (tag === 'select') {
                    this.selectedIndex = -1;
                }

                $(this).removeClass('is-valid').removeClass('is-invalid');

            });

            $( boilerPlateVars ).each(function (i, el ) {
                $form.find('.' + el ).html( '' );
            });

            this.find('.message-container, .form-message').children().remove();
            this.find('.message-container, .form-message').tigerDOM('reset');

        },

        /**
         * A convenience method used to populate non-select form controls.
         *
         * @param formValues
         */
        setFormValues : function ( formValues, staticDataVars ) {

            /** "this" is already a jQuery from object. */

            let boilerPlateVars = [
                'create_user_id',   'update_user_id',   'create_date',
                'update_date',      'create_ip',        'update_ip',
                'last_login_date',  'last_login_ip',    'password_reset_key',
                'email_verify_key'
            ];

            for ( let key in formValues ) {

                let $el = $(this).find('[name="' + key + '"]' );

                if ( $el.length > 0 && formValues[key] ) {

                    if ( $el.not('input:checkbox, input:radio').is('input:text, input:hidden, textarea') ) {
                        $el.val( formValues[key] );
                    }

                    if ( $el.is('input:checkbox, input:radio') ) {
                        if ( formValues[key] === $el.val() ) {
                            $el.attr('checked', 'checked').prop('checked', true);
                        }
                        else {
                            $el.removeAttr('checked').prop('checked', false);
                        }
                    }

                    if ( $el.is('select') ) {
                        $el.val( formValues[key] );
                        if ( $el.hasClass('select2') ) {
                            $el.trigger('change');
                        }
                    }

                }

                /** StaticDataVars are optional form data that is read-only. */
                else if ( staticDataVars && $.inArray( key, staticDataVars ) > -1 ) {
                    $(this).find('.' + key ).html( formValues[key] );
                }

                /** BoilerplateVars are standard form data that is read-only. */
                else if ( $.inArray(key, boilerPlateVars) > -1 ) {
                    $(this).find('.' + key ).html( formValues[key] );
                }

            }

        },

        /**
         * A convenience method used to return a JSON compatible array of the form's values.
         *
         * @param object | null params that will be added to the form values.
         * @returns object
         */
        getFormValues : function ( formValues ) {

            if ( formValues === undefined ) {
                formValues = {};
            }

            let value = null;

            $( this ).find(':input').each(function (i, el) {

                if ( $(el).is(':checkbox') || $(el).is(':radio') ) {
                    value = ( $(el).is(':checked') ) ? 1 : 0
                }
                else {
                    value = el.value;
                }

                formValues[el.name] = value;

            });

            return formValues;

        },

        persistConfigKey : function ( params ) {

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( data.html ) {

                    $('#page-messages').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                $( '#page-messages' ).css('overflow', 'hidden').tigerDOM('change', {
                    content: '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick: true,
                    removeTimeout: 0
                });

            }

            params.service = 'core:admin';
            params.method  = 'persistConfigKey';

            $.ajax({
                dataType :  'json',
                type     :  'POST',
                url      :  '/api',
                data     :  params,
                success  :  success,
                error    :  error
            });

        },

        initAutoValidate : function ( ) {

            return $( 'input[data-valid], select[data-valid]' )
                .not( 'input[type=hidden]' )
                .not( '.no-validate' ).each( function( i, el ) {
                    Class._setAjaxValidate( el );
                });

        },

        autoValidate : function ( ) {
            Class._setAjaxValidate( this );
            return $( this );
        },

        autoValidateOff : function ( ) {
            $( this ).off('click.autovalidate').off('change.autovalidate').off('blur.autovalidate');
            return $( this );
        },

        _setAjaxValidate : function ( el ) {

            let $this = $( el );

            if ( $this.is('input:radio') ) { $this.on( 'click.autovalidate', Class._ajaxValidate ); }
            else if ( $this.is('input:checkbox') ) { $this.on( 'click.autovalidate', Class._ajaxValidate ); }
            else if ( $this.is('select') ) { $this.on( 'change.autovalidate', Class._ajaxValidate ); }
            else if ( $this.is('textarea') ) { $this.on( 'blur.autovalidate', Class._ajaxValidate ); }
            else if ( $this.is('input') ) { $this.on( 'blur.autovalidate', Class._ajaxValidate ); }

            // Set change detection so that we only validate on a changed field //
            $this.attr( 'data-value', $this.val() );

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
                context : $this.attr('data-context'),
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

            function success ( data ) {
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

            let $form = ( typeof data.form === 'string' )
                ? $('form[name="' + data.form + '"]' )
                : $( data.form );

            let $element = ( typeof data.element === 'string' )
                ? $form.find( '#' + data.element )
                : $(data.element);

            if ( data.result === 0 ) {

                let content = '<div id="' + data.element + '-error" class="invalid-feedback">' + data.messages[0].message + '</div>';
                $element.closest('div.form-group').find('.message-container').tigerDOM('change', { content : content } );
                $element.addClass('is-invalid');

            }
            else {

                $element.closest('div.form-group').find('.message-container').tigerDOM('change', { content : '' } );
                $element.removeClass( 'is-invalid' ).addClass('is-valid');

            }

        },

        initBlockOptions : function ( ) {

            $('div.block-options [data-tiger-reload-table]').on('click', function ( event ) {

                let datatable = $(this).attr('data-tiger-reload-table');
                let $block = $(this).closest('div.block');

                $( datatable ).DataTable().on('preDraw.block', function ( event ) {
                    One.block('state_loading', $block );
                });

                $( datatable ).DataTable().on('draw.block', function( event ) {
                    /** Added a 1 sec. delay for the keen reload animation to play. */
                    setTimeout( function () {
                        One.block('state_normal', $block);
                        $(datatable).DataTable().off('preDraw.block');
                        $(datatable).DataTable().off('draw.block');
                    }, 1000);
                });

                $( datatable ).DataTable().ajax.reload();
                // $( datatable ).DataTable().draw();

            });

        },

        initAutoPersist : function ( ) {

            return $( 'input[data-persist], select[data-persist]' )
                .not( 'input[type=hidden]' ).each( function( ) {

                    let $this = $(this);

                    if ( $this.is('input:radio') ) { $(this).on( 'click.autopersist', Class._ajaxPersist ); }
                    else if ( $this.is('input:checkbox') ) { $(this).on( 'click.autopersist', Class._ajaxPersist ); }
                    else if ( $this.is('select') ) { $(this).on( 'change.autopersist', Class._ajaxPersist ); }
                    else if ( $this.is('textarea') ) { $this.on( 'blur.autopersist', Class._ajaxPersist ); }
                    else if ( $this.is('input') ) { $this.on( 'blur.autopersist', Class._ajaxPersist ); }

                    // Set change detection so that we only persist on a changed field //
                    $this.attr( 'data-value', $this.val() );

                });

        },

        _ajaxPersist : function ( event ) {

            let $this = $( this );

            Class.persistAjax.push( $this.attr('id') );

            // Set the base post data object //
            let data = {
                service : 'core:admin',
                method  : 'persist',
                model   : $this.closest('form').attr('data-model'),
                form    : $this.closest('form').attr('name'),
                id      : $this.attr('id'),
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
