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
 * jQuery Tiger Admin Org Address Plugin
 */

(function( $ ){

    let Class = {

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initControls();

            });

        },

        // Admin Functions //

        _initControls : function () {

            $('#address-form #address').accountAddressLookup('attach');

            $('#save-address-button').on( 'click', Class._save );

            $('body').on( 'click', 'table i.address', Class._view );

            Class._initSAddressIdSelect2();
            Class._initTypeAddressSelect2();
            Class._initCountrySelect2();

        },

        // Select2 Controls //

        _initSAddressIdSelect2 ( ) {

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 10,
                    order       : 'create_date ASC',
                    service     : 'account:admin',
                    method      : 'getAdminAddressSelect2List',
                    entity      : $('#address-form #entity').val(),
                    entity_id   : $('#address-form #entity_id').val()
                }

                return query;

            }

            $('#address-form #address_id').select2({
                minimumResultsForSearch : -1,
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                },
                escapeMarkup: function( markup ) {
                    return markup;
                },
                templateSelection: function(data) {
                    let html = '<span>';
                    html += ( parseInt(data.primary,10) === 1 ) ? '<i class="fa fa-star"></i> ' : '<i> </i>';
                    html += ( data.id ) ? data.type + ' - ' : '';
                    html += data.text
                    return html;
                },
                templateResult : function ( data ){
                    let html = '<span>';
                    html += ( parseInt(data.primary,10) === 1 ) ? '<i class="fa fa-star"></i> ' : '<i> </i>';
                    html += ( data.id ) ? data.type + ' - ' : '';
                    html += data.text
                    return html;
                }
            });

            $('#address-form #address_id')
                .off('select2:select')
                .on('select2:select', Class._edit );

        },

        _initTypeAddressSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'address',
                    key         : ''
                }

                return query;

            }

            $('#address-form #type_address').select2({
                minimumResultsForSearch : -1,
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeAddressSelect2 ( type_address ) {

            if ( ! type_address ) { return; }

            let $typeAddress = $('#address-form #type_address');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/address/key/' + type_address
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeAddress.append(option).trigger('change');

                $typeAddress.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initCountrySelect2 ( ) {

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 15,
                    service     : 'account:admin',
                    method      : 'getCountrySelect2List',
                }

                return query;

            }

            $('#address-form #country').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setCountrySelect2 ( country ) {

            if ( ! country ) { return; }

            let $typeAddress = $('#address-form #country');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getCountrySelect2List/search/' + country
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeAddress.append(option).trigger('change');

                $typeAddress.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },


        // CRUD Functions //

        _resetAddress ( exclude ) {

            $('#address-form').tigerForm('reset', exclude );
            $('#address-form #type_address').select2('destroy');
            $('#address-form #country').select2('destroy');
            Class._initTypeAddressSelect2();
            Class._initCountrySelect2();

        },

        _view : function ( event ) {

            Class._resetAddress();
            $('#address-form #address_id').select2('destroy');
            Class._initSAddressIdSelect2();

            /**
             * The address form is used by both orgs and users, so we need to
             * tell the form, service and eventually the model which tyep of
             * entitu and entity_id we are using..
             */
            $('#address-form #entity').val( $(this).closest('table').attr('data-entity') );
            $('#address-form #entity_id').val( $(this).attr('data-id') );

            $('#modal-address-form').modal('show');

        },

        _edit : function ( event ) {

            $('#address-form').find('div.overlay').animate({'opacity': '0'}, 400, function (){
                $(this).css('display','none');
            });

            /** if the value is empty, then it's a new address. Just clear the form and return. */
            if ( ! $('#address-form #address_id').val() ) {

                Class._resetAddress(['address_id']);
                return;

            }

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#address-form').tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeAddressSelect2( data.data.type_address );
                    Class._setCountrySelect2( data.data.country );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#address-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#address-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

            }

            let data = {
                service     : 'account:admin',
                method      : 'getAddress',
                address_id  : $('#address-form #address_id').val()
            };

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

        },

        _save : function ( event ) {

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    $('#address-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#address-form .form-message')
                            .css('overflow', 'hidden')
                            .tigerDOM('insert', {
                                content: data.html[0],
                                removeClick: true,
                                removeTimeout: 0
                            });

                    }

                    if ( data.messages ) {

                        let msgData = {
                            result: 0,
                            form: 'Account_Form_Address',
                            element: null,
                            messages: []
                        };

                        $.each(data.messages, function (el, msgObj) {

                            // console.log( el, msgObj );

                            msgData.element = el;
                            msgData.messages = [];

                            $.each(msgObj, function (errName, errMsg) {
                                // console.log(errName, errMsg);
                                msgData.messages.push({message: errMsg, error: errName, class: "alert"});
                            });

                            // console.log( msgData );

                            $().tigerForm('_setElementMessage', msgData);

                        });

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                $('#address-form .form-message').css('overflow','hidden').tigerDOM( 'change', {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                });

            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service     : 'account:admin',
                method      : 'saveAddress',
                address_id  : $('#address-form #address_id').val(),
                entity      : $('#address-form #entity').val(),
                entity_id   : $('#address-form #entity_id').val(),
                active      : ( $('#address-form #active').is(':checked') ) ? 1 : 0,
                deleted     : ( $('#address-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#address-form').tigerForm('getFormValues', apiParams );

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

    $.fn.accountAdminOrgAddress = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };

    $().accountAdminOrgAddress();

})( jQuery );
