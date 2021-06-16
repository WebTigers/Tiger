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
 * jQuery Tiger Setup Plugin
 */

(function( $ ){
    
    let Class = {

        observers : [],

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //

                $('#modal-setup-form').modal('show');

                $('button.generate').on('click', function ( event ) {
                    $(this).closest('.input-group').find('input').focus().val( Class._generate() ).blur();
                });

                $('button.fetch-token').on( 'click', Class._fetch );

                $('#modal-setup-form [data-wizard="finish"]').on('click', Class.saveSetup );

                Class._initFormWizard();
                Class._initCopy();
                Class._initSelect2();
                Class._initObservers();

            });

        },

        _initFormWizard : function () {

            $().tigerFormWizard('initFormWizard', {
                form : $('#setup-form'),
                tabs : $('.tiger-form-wizard .nav-tabs'),
                prevButton : $('#modal-setup-form [data-wizard="prev"]'),
                nextButton : $('#modal-setup-form [data-wizard="next"]'),
                finishButton : $('#modal-setup-form [data-wizard="finish"]')
            });

        },

        // Admin Functions //

        _generate : function ( ) {

            let min                 = 50,
                max                 = 150,
                length              = Math.random() * (max - min) + min,
                result              = [],
                characters          = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
                charactersLength    = characters.length,
                i;

            for ( i = 0; i < length; i++ ) {
                result.push( characters.charAt( Math.floor(Math.random() * charactersLength) ) );
            }

            return result.join('');

        },

        _fetch : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#setup-form #github_oauth_token').val( data.data );

                }
                else {

                    /** Oops, something went wrong ... */

                    if ( data.html ) {

                        $( '#form-setup-message' ).css('overflow','hidden').tigerDOM( 'change', {
                            content       : data.html[0],
                            removeClick   : true,
                            removeTimeout : 0
                        });

                    }

                    /** show element error messages */
                    if ( data.messages ) {

                        let msgData = {
                            result : 0,
                            form : 'Core_Form_Setup',
                            element : null,
                            messages : []
                        };

                        $.each( data.messages, function ( el, msgObj ) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each( msgObj, function (errName, errMsg) {
                                msgData.messages.push( {message: errMsg, error: errName, class: "alert"} );
                            });

                            $().tigerForm('_setElementMessage', msgData );

                        });

                        Class._setTabColor();

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-setup-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let url = $('#setup-form #github_oauth_token').attr( 'data-token-url' );

            $.ajax({
                type        : "POST",
                url         : url,
                dataType    : "json",
                data        : null,
                beforeSend  : beforeSend,
                complete    : complete,
                success     : success,
                error       : error
            });

        },

        _initCopy : function ( ) {

            /** For convenience, we copy certain fields to the registration part of the form. */

            $( '#admin_first_name' ).on( 'keyup', function ( event ) {
                $( '#first_name' ).val( $(this).val() );
            });

            $( '#admin_first_name' ).on( 'blur', function ( event ) {
                $( '#first_name' ).trigger( 'blur' );
            });

            $( '#admin_last_name' ).on( 'keyup', function ( event ) {
                $( '#last_name' ).val( $(this).val() );
            });

            $( '#admin_last_name' ).on( 'blur', function ( event ) {
                $( '#last_name' ).trigger( 'blur' );
            });

            $( '#admin_email' ).on( 'keyup', function ( event ) {
                $( '#email' ).val( $(this).val() );
            });

            $( '#admin_email' ).on( 'blur', function ( event ) {
                $( '#email' ).trigger( 'blur' );
            });

        },

        _initSelect2 : function ( ) {

            $( '#country' ).select2({
                'minimumResultsForSearch' : 5
            });
            $( '#type_profession' ).select2({
                'minimumResultsForSearch' : -1
            });
            $( '#type_hearabout' ).select2({
                'minimumResultsForSearch' : -1
            });

        },

        _initObservers : function ( ) {

            $('#setup-form input, #setup-form select').each( function( i, el ) {
                Class.observers[i] = new MutationObserver( Class._setTabColor );
                Class.observers[i].observe( el, { attributes: true } );
            });

        },

        _setTabColor : function ( list, observer ) {

            // Gather all of the form's tab-panes
            $('#setup-form .tab-pane').each(function( i, el ) {
                if ( $( el ).find('input.is-invalid, select.is-invalid').length > 0 ) {
                    $( el ).closest('form').parent().find('a[href="#' + $( el ).attr('id') + '"]').addClass('is-invalid');
                }
                else {
                    $( el ).closest('form').parent().find('a[href="#' + $( el ).attr('id') + '"]').removeClass('is-invalid');
                }
            });

        },

        saveSetup : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#modal-setup-form [data-wizard="finish"] i.icon').addClass('hide');
                $('#modal-setup-form [data-wizard="finish"] i.ajax').removeClass('hide');
                $('#modal-setup-form [data-wizard="finish"]').addClass('disabled').prop('disabled', true);
            }

            function complete ( jqXHR, textStatus ) {
                $('#modal-setup-form [data-wizard="finish"] i.icon').removeClass('hide');
                $('#modal-setup-form [data-wizard="finish"] i.ajax').addClass('hide');
                $('#modal-setup-form [data-wizard="finish"]').removeClass('disabled').prop('disabled', false);
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.confirm = null;
                    $('#modal-setup-form').modal('hide');
                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }
                else {

                    /** Oops, something went wrong ... */

                    if ( data.html ) {

                        $( '#form-setup-message' ).css('overflow','hidden').tigerDOM( 'change', {
                            content       : data.html[0],
                            removeClick   : true,
                            removeTimeout : 0
                        });

                    }

                    /** show element error messages */
                    if ( data.messages ) {

                        let msgData = {
                            result : 0,
                            form : 'Core_Form_Setup',
                            element : null,
                            messages : []
                        };

                        $.each( data.messages, function ( el, msgObj ) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each( msgObj, function (errName, errMsg) {
                                msgData.messages.push( {message: errMsg, error: errName, class: "alert"} );
                            });

                            $().tigerForm('_setElementMessage', msgData );

                        });

                        Class._setTabColor();

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-setup-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'core:adminSetup',
                method  : 'setup',
            };

            /** Note that our API params will be added to the form data */
            let data = $('#setup-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.coreAdminSetup = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().coreAdminSetup();
    
})( jQuery );
