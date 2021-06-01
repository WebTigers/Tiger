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
 * jQuery Tiger Profile Address Plugin
 */

(function( $ ){

    let $userAddressForm = $('#user-form-address');
    let $orgAddressForm = $('#org-form-address');

    let Class = {

        currentAddressId : null,

        lookupAvailable : true,
        lookupLocations : [],
        lookupPending : null,
        lookupXHR : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initControls();

            });

        },

        // Admin Functions //

        _initControls : function () {

            $('#save-user-address-button, #save-org-address-button').on( 'click', Class._save );
            $('#remove-user-address-button, #remove-org-address-button').on( 'click', Class._remove );
            $('#user-form-address #address, #org-form-address #address').on( 'keyup', Class._addressLookupQueue );
            $('#user-form-address #address, #org-form-address #address').on( 'blur', function(){
                setTimeout( function(){ $('#address-panel').hide(); }, 200);
            });
            $('body').on('click', '#address-panel ul li', Class._autofillAddress )

            Class._initSAddressIdSelect2( $userAddressForm, 'user' );
            Class._initSAddressIdSelect2( $orgAddressForm, 'org' );
            Class._initTypeAddressSelect2( $userAddressForm );
            Class._initTypeAddressSelect2( $orgAddressForm );
            Class._initCountrySelect2( $userAddressForm );
            Class._initCountrySelect2( $orgAddressForm );

        },

        // Select2 Controls //

        _initSAddressIdSelect2 : function ( $addressForm ) {

            let entity = $addressForm.attr('id').split('-')[0];
            let type_address_id = entity + '_address_id';
            $addressForm.find('#address_id').attr('id', type_address_id);

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 10,
                    order       : 'create_date ASC',
                    service     : 'account:account',
                    method      : 'getAddressSelect2List',
                    entity      : entity
                }

                return query;

            }

            $addressForm.find( '#' + type_address_id ).select2({
                minimumResultsForSearch : -1,
                width : '100%',
                ajax : {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                },
                escapeMarkup : function( markup ) {
                    return markup;
                },
                templateSelection : function(data) {
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

            $addressForm.find( '#' + type_address_id ).on('select2:select', Class._edit );

        },

        _initTypeAddressSelect2 : function ( $addressForm ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'address',
                    key         : ''
                }

                return query;

            }

            $addressForm.find('#type_address').select2({
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

        _setTypeAddressSelect2 : function ( $addressForm, type_address ) {

            if ( ! type_address ) { return; }

            let $typeAddress = $addressForm.find('#type_address');

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

        _initCountrySelect2 : function ( $addressForm ) {

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 15,
                    service     : 'account:account',
                    method      : 'getCountrySelect2List',
                }

                return query;

            }

            $addressForm.find('#country').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setCountrySelect2 : function ( $addressForm, country ) {

            if ( ! country ) { return; }

            let $typeAddress = $addressForm.find('#country');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:account/method/getCountrySelect2List/search/' + country
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

        _addressLookupQueue : function ( event ) {

            /**
             * If we figure out that address lookup is not available,
             * don't keep hitting the service, just return.
             */
            if (!Class.lookupAvailable) {
                return;
            }

            /** Don't start the lookup until with have at least 5 characters to work with. */
            if ($(event.target).val().length < 6) {
                return;
            }

            /**
             * Lookup pending is a way to pause making the ajax lookup request for every keystroke.
             * We essentially wait one second after each key stroke before making the request to allow
             * for additional character to be entered.
             */
            if ( Class.lookupPending ) {
                clearTimeout( Class.lookupPending );
            }

            Class.lookupPending = setTimeout(function ( e ) {

                /** If we have a lookup request in progress, attempt to cancel it and start a new one. */
                if ( Class.lookupXHR && Class.lookupXHR.readyState !== 4 ) {
                    Class.lookupXHR.abort();
                }

                Class._addressLookup( event );

            }, 1000);

        },

        _addressLookup : function ( event ) {

            let $form = $( event.target ).closest('form');

            function beforeSend () {
                $(event.target).closest('div').find('.address-lookup-spinner').removeClass('hide');
            }

            function complete () {
                $(event.target).closest('div').find('.address-lookup-spinner').addClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.lookupLocations = data.data.Results;
                    Class._buildDropdown( event.target );

                }
                else {

                    if ( data.data = 'not_configured' ) {
                        Class.lookupAvailable = false;
                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {
            }

            let data = {
                service : 'account:account',
                method  : 'getAddressLookupAWS',
                address : $form.find('#address').val()
            };

            Class.lookupCall = $.ajax({
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

        _buildDropdown : function ( el ) {

            /**
             Country: "USA"
             Geometry:
                 Point: Array(2)
                     0: -112.18264
                     1: 38.57031
                 length: 2
             Label: "County Road 1162P, Sevier, UT 84766, United States"
             Municipality: "Sevier"
             PostalCode: "84766"
             Region: "Utah"
             Street: "County Road 1162P"
             SubRegion: "Sevier"
             */

            let $addressPanel = $(el).closest('.form-group').find('#address-panel'), $option;

            if ( Class.lookupLocations.length > 0 ) {

                $addressPanel.remove();

                // Generate and show the select address panel //

                $addressPanel = $('<div id="address-panel"><ul></ul></div>');

                $.each(Class.lookupLocations, function ( i, address ) {
                    $option = $('<li data-option="' + i + '">' + address.Place.Label + '</li>');
                    $addressPanel.find('ul').append( $option );
                });

                $(el).closest('.form-group').find('#select-address-container').append( $addressPanel );

            }
            else {

                // Remove the address panel //
                $addressPanel.remove();
            }

        },

        _autofillAddress : function ( event ) {

            let $form = $(event.target).closest('form');
            let address = Class.lookupLocations[ $(event.target).attr('data-option') ].Place;

            let state = ( address.Country === 'USA' )
                ? Class._getStateAbbreviation( address.Region )
                : address.Region;

            let streetAddress = address.AddressNumber + ' ' + address.Street;
            $form.find('#address').val( streetAddress ).trigger('blur');
            $form.find('#address2').val( '' ).trigger('blur');
            $form.find('#city').val( address.Municipality ).trigger('blur');
            if ( $form.find('#county').is(':visible') ) {
                $form.find('#county').val(address.SubRegion).trigger('blur');
            }
            $form.find('#state').val( state ).trigger('blur');
            $form.find('#postal_code').val( address.PostalCode ).trigger('blur');
            Class._setCountrySelect2( $form,  address.Country );
            $form.find('#lat').val( address.Geometry.Point[1] ).trigger('blur');
            $form.find('#lng').val( address.Geometry.Point[0] ).trigger('blur');

            $('#address-panel').remove();

        },

        _getStateAbbreviation : function ( stateName ) {
            let abbreviation = stateName;
            $.each( Class._states, function ( i, state ){
                if ( state.State === stateName ) {
                    abbreviation = state.Code;
                }
            });
            return abbreviation;
        },

        // CRUD Functions //

        _resetAddress : function ( $addressForm, exclude ) {

            $addressForm.tigerForm('reset', exclude );
            $addressForm.find('#type_address').select2('destroy');
            $addressForm.find('#country').select2('destroy');

            Class._initTypeAddressSelect2( $addressForm );
            Class._initCountrySelect2( $addressForm );

        },

        _edit : function ( event ) {

            let $form = $( this ).closest('form');

            Class._resetAddress( $form, []);
            $('#remove-user-address-button').prop('disabled', false);
            $form.find('div.overlay').animate({'opacity': '0'}, 400, function (){
                $(this).css('display','none');
            });

            /** if the value is empty, then it's a new address. Just clear the form and return. */
            if ( event.params.data.id === '' ) {
                $('#remove-user-address-button').prop('disabled', true);
                return;
            }

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $form.tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeAddressSelect2( $form, data.data.type_address );
                    Class._setCountrySelect2( $form, data.data.country );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
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

            Class.currentAddressId = event.params.data.id;

            let data = {
                service     : 'account:account',
                method      : 'getAddress',
                address_id  : event.params.data.id,
                entity      : $form.find('#entity').val()
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

            let $form = $( this ).closest('form');

            function beforeSend () {
                $(this).find('i.ajax').removeClass('hide');
                $(this).find('i.icon').addClass('hide');
            }

            function complete () {
                $(this).find('i.ajax').addClass('hide');
                $(this).find('i.icon').removeClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    $('#page-messages').css('overflow', 'hidden').tigerDOM('change', {
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

                            msgData.element = el;
                            msgData.messages = [];

                            $.each(msgObj, function (errName, errMsg) {
                                msgData.messages.push({message: errMsg, error: errName, class: "alert"});
                            });

                            $().tigerForm('_setElementMessage', msgData);

                        });

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                $('#page-messages').css('overflow','hidden').tigerDOM( 'change', {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                });

            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service     : 'account:account',
                method      : 'saveAddress',
                address_id  : Class.currentAddressId,
                entity      : $form.find('#entity').val()
            };

            /** Note that our API params will be added to the form data */
            let data = $form.tigerForm('getFormValues', apiParams );

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

        _remove : function ( event ) {

            let $form = $( this ).closest('form');

            function beforeSend ( jqXHR, settings ) {
                $(this).find('i.ajax').removeClass('hide');
                $(this).find('i.icon').addClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $(this).find('i.ajax').addClass('hide');
                $(this).find('i.icon').removeClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class._resetAddress( $form, [] );
                    $form.find('#address_id').select2('destroy');
                    Class._initSAddressIdSelect2( $form );

                }

                /** Oops, something went wrong ... */

                $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                    content       : data.html[0],
                    removeClick   : true,
                    removeTimeout : 0
                });

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
                service     : 'account:account',
                method      : 'removeAddress',
                address_id  : Class.currentAddressId,
                entity      : $form.find('#entity').val()
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

        _states : [
            {
                "State": "Alabama",
                "Abbrev": "Ala.",
                "Code": "AL"
            },
            {
                "State": "Alaska",
                "Abbrev": "Alaska",
                "Code": "AK"
            },
            {
                "State": "Arizona",
                "Abbrev": "Ariz.",
                "Code": "AZ"
            },
            {
                "State": "Arkansas",
                "Abbrev": "Ark.",
                "Code": "AR"
            },
            {
                "State": "California",
                "Abbrev": "Calif.",
                "Code": "CA"
            },
            {
                "State": "Colorado",
                "Abbrev": "Colo.",
                "Code": "CO"
            },
            {
                "State": "Connecticut",
                "Abbrev": "Conn.",
                "Code": "CT"
            },
            {
                "State": "Delaware",
                "Abbrev": "Del.",
                "Code": "DE"
            },
            {
                "State": "District of Columbia",
                "Abbrev": "D.C.",
                "Code": "DC"
            },
            {
                "State": "Florida",
                "Abbrev": "Fla.",
                "Code": "FL"
            },
            {
                "State": "Georgia",
                "Abbrev": "Ga.",
                "Code": "GA"
            },
            {
                "State": "Hawaii",
                "Abbrev": "Hawaii",
                "Code": "HI"
            },
            {
                "State": "Idaho",
                "Abbrev": "Idaho",
                "Code": "ID"
            },
            {
                "State": "Illinois",
                "Abbrev": "Ill.",
                "Code": "IL"
            },
            {
                "State": "Indiana",
                "Abbrev": "Ind.",
                "Code": "IN"
            },
            {
                "State": "Iowa",
                "Abbrev": "Iowa",
                "Code": "IA"
            },
            {
                "State": "Kansas",
                "Abbrev": "Kans.",
                "Code": "KS"
            },
            {
                "State": "Kentucky",
                "Abbrev": "Ky.",
                "Code": "KY"
            },
            {
                "State": "Louisiana",
                "Abbrev": "La.",
                "Code": "LA"
            },
            {
                "State": "Maine",
                "Abbrev": "Maine",
                "Code": "ME"
            },
            {
                "State": "Maryland",
                "Abbrev": "Md.",
                "Code": "MD"
            },
            {
                "State": "Massachusetts",
                "Abbrev": "Mass.",
                "Code": "MA"
            },
            {
                "State": "Michigan",
                "Abbrev": "Mich.",
                "Code": "MI"
            },
            {
                "State": "Minnesota",
                "Abbrev": "Minn.",
                "Code": "MN"
            },
            {
                "State": "Mississippi",
                "Abbrev": "Miss.",
                "Code": "MS"
            },
            {
                "State": "Missouri",
                "Abbrev": "Mo.",
                "Code": "MO"
            },
            {
                "State": "Montana",
                "Abbrev": "Mont.",
                "Code": "MT"
            },
            {
                "State": "Nebraska",
                "Abbrev": "Nebr.",
                "Code": "NE"
            },
            {
                "State": "Nevada",
                "Abbrev": "Nev.",
                "Code": "NV"
            },
            {
                "State": "New Hampshire",
                "Abbrev": "N.H.",
                "Code": "NH"
            },
            {
                "State": "New Jersey",
                "Abbrev": "N.J.",
                "Code": "NJ"
            },
            {
                "State": "New Mexico",
                "Abbrev": "N.M.",
                "Code": "NM"
            },
            {
                "State": "New York",
                "Abbrev": "N.Y.",
                "Code": "NY"
            },
            {
                "State": "North Carolina",
                "Abbrev": "N.C.",
                "Code": "NC"
            },
            {
                "State": "North Dakota",
                "Abbrev": "N.D.",
                "Code": "ND"
            },
            {
                "State": "Ohio",
                "Abbrev": "Ohio",
                "Code": "OH"
            },
            {
                "State": "Oklahoma",
                "Abbrev": "Okla.",
                "Code": "OK"
            },
            {
                "State": "Oregon",
                "Abbrev": "Ore.",
                "Code": "OR"
            },
            {
                "State": "Pennsylvania",
                "Abbrev": "Pa.",
                "Code": "PA"
            },
            {
                "State": "Rhode Island",
                "Abbrev": "R.I.",
                "Code": "RI"
            },
            {
                "State": "South Carolina",
                "Abbrev": "S.C.",
                "Code": "SC"
            },
            {
                "State": "South Dakota",
                "Abbrev": "S.D.",
                "Code": "SD"
            },
            {
                "State": "Tennessee",
                "Abbrev": "Tenn.",
                "Code": "TN"
            },
            {
                "State": "Texas",
                "Abbrev": "Tex.",
                "Code": "TX"
            },
            {
                "State": "Utah",
                "Abbrev": "Utah",
                "Code": "UT"
            },
            {
                "State": "Vermont",
                "Abbrev": "Vt.",
                "Code": "VT"
            },
            {
                "State": "Virginia",
                "Abbrev": "Va.",
                "Code": "VA"
            },
            {
                "State": "Washington",
                "Abbrev": "Wash.",
                "Code": "WA"
            },
            {
                "State": "West Virginia",
                "Abbrev": "W.Va.",
                "Code": "WV"
            },
            {
                "State": "Wisconsin",
                "Abbrev": "Wis.",
                "Code": "WI"
            },
            {
                "State": "Wyoming",
                "Abbrev": "Wyo.",
                "Code": "WY"
            }
        ]

    };

    $.fn.accountAddress = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };

    $().accountAddress();

})( jQuery );
