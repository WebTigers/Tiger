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
 * jQuery Tiger Account Org Profile Plugin
 */

(function( $ ){
    
    let Class = {

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //

                Class._initOrgForm();
                Class._getOrg();

            });

        },

        // Profile Functions //

        _initTypeOrgSelect2 : function ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'org',
                    key         : ''
                }

                return query;

            }

            $('#org-form #type_org').select2({
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

        _setTypeOrgSelect2 : function ( type_org ) {

            if ( ! type_org ) { return; }

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/org/key/' + type_org
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $('#org-form #type_org').append(option).trigger('change');

                $('#org-form #type_org').trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initTypeBusinessSelect2 : function ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'business',
                    key         : ''
                }

                return query;

            }

            $('#org-form #type_business').select2({
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

        _setTypeBusinessSelect2 : function ( type_business ) {

            if ( ! type_business ) { return; }

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/business/key/' + type_business
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $('#org-form #type_business').append(option).trigger('change');

                $('#org-form #type_business').trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initOrgForm : function () {

            Class._initTypeOrgSelect2();
            Class._initTypeBusinessSelect2();

            $('#save-org-button').on( 'click', Class._saveOrg );

        },

        _getOrg : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    if ( data.data.type_org === 'DEFAULT' ) {
                        $('div.default-org').removeClass('hide');
                        return;
                    }
                    else if ( data.data.type_user_role === 'MEMBER' ) {
                        $('div.org-admin').removeClass('hide');
                        return;
                    }

                    $('div.org-overlay .overlay').hide();
                    $('#org-form').tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeOrgSelect2( data.data.type_org );
                    Class._setTypeBusinessSelect2( data.data.type_business );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#form-messages-profile' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#form-message-profile' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'account:account',
                method  : 'getProfileOrg',
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

        _saveOrg : function ( event ) {

            function beforeSend () {

                /* Disable any elements if you like. */
                // $('#form_id').find('input, select').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#save-user-button .ajax').toggleClass( 'hide' );
                $('#save-user-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                // $('#form_id').find('input, select').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#save-user-button .ajax').toggleClass( 'hide' );
                $('#save-user-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {
                
                // Save User Profile Success / Error //
                if (parseInt(data.result, 10) === 1) {

                    $('#page-messages').css('overflow', 'hidden').tigerDOM( 'change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#page-messages').css('overflow', 'hidden').tigerDOM('change', {
                                content: data.html[0],
                                removeClick: true,
                                removeTimeout: 0
                            });

                    }

                    if ( data.messages ) {

                        let msgData = {
                            result: 0,
                            form: 'Account_Form_User',
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

                // grecaptcha.reset( reCaptchaSignup );
                
                // show general error message
                let oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );
                
            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'account:account',
                method  : 'saveOrg'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#org-form').tigerForm('getFormValues', apiParams );

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

    };
  
    $.fn.accountOrg = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountOrg();
    
})( jQuery );
