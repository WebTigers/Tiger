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

    let Class = {

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

            $('body').on('click', '#address-panel ul li', Class._autofillAddress )

        },

        attach : function ( ) {

            $(this).on( 'keyup', Class._addressLookupQueue );

            $(this).on( 'blur', Class._hidePanel );

        },

        _hidePanel : function ( event ) {

            setTimeout( function(){ $('#address-panel').hide(); }, 200);

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

        _getStateAbbreviation : function ( stateName ) {
            let abbreviation = stateName;
            $.each( Class._states, function ( i, state ){
                if ( state.State === stateName ) {
                    abbreviation = state.Code;
                }
            });
            return abbreviation;
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

    $.fn.accountAddressLookup = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };

    $().accountAddressLookup();

})( jQuery );
