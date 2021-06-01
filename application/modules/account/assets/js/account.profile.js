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
 * jQuery Tiger Account Profile Plugin
 */

(function( $ ){
    
    let Class = {
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //

                Class._initProfileForm();
                Class._getUser();
                Class._initPasswordForm();

            });

        },

        // Profile Functions //

        _initTypeTitleSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:account',
                    method      : 'getTypeSelect2List',
                    reference   : 'title'
                }

                return query;

            }

            $('#user-form-profile #type_title').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeTitleSelect2 ( type_title ) {

            if ( ! type_title ) { return; }

            let $typeTitle = $('#user-form-profile #type_title');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:account/method/getTypeSelect2List/reference/title/key/' + type_title
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeTitle.append(option).trigger('change');

                $typeTitle.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initTypeSuffixSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:account',
                    method      : 'getTypeSelect2List',
                    reference   : 'suffix'
                }

                return query;

            }

            $('#user-form-profile #type_suffix').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeSuffixSelect2 ( type_suffix ) {

            if ( ! type_suffix ) { return; }

            let $typeSuffix = $('#user-form-profile #type_suffix');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:account/method/getTypeSelect2List/reference/suffix/key/' + type_suffix
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeSuffix.append(option).trigger('change');

                $typeSuffix.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initProfileForm : function () {

            Class._initTypeTitleSelect2();
            Class._initTypeSuffixSelect2();

            $('#select-avatar').on( 'click', Class._showAvatars );
            $('#save-user-button').on( 'click', Class._saveProfile );
            $('body').on( 'click', '#gallery .options-container', Class._selectAvatar );

        },

        _initPasswordForm : function () {

            $('#save-password-button').on( 'click', Class._savePassword );

        },

        _showAvatars : function ( event ) {

            $( '#modal-avatar-form' ).modal('show');

        },

        _selectAvatar : function ( event ) {

            let src = $(this).find('img').attr('src');

            $( 'img.img-avatar' ).attr('src', src );
            $( '#page-header-user-dropdown img.rounded' ).attr('src', src );

            src = ( $(this).find('img').hasClass('default') ) ? null : src;
            $( '#user-form-profile #avatar_url' ).val( src );

            $( '#modal-avatar-form' ).modal('hide');

            $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                content       : $('#change-message').children()[0],
                removeClick   : true,
                removeTimeout : 0
            });


        },

        _getUser : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#user-form-profile').tigerForm('setFormValues', data.data );
                    if ( data.data.avatar_url ) {
                        // $('img.img-avatar').attr('src', data.data.avatar_url );
                    }

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeTitleSelect2( data.data.type_title );
                    Class._setTypeSuffixSelect2( data.data.type_suffix );

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
                method  : 'getUserProfile',
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

        _saveProfile : function ( event ) {

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
                method  : 'saveUser'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#user-form-profile').tigerForm('getFormValues', apiParams );

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

        _savePassword : function ( event ) {

            function beforeSend () {

                /* Disable any elements if you like. */
                // $('#form_id').find('input, select').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#save-password-button .ajax').toggleClass( 'hide' );
                $('#save-password-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                // $('#form_id').find('input, select').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#save-password-button .ajax').toggleClass( 'hide' );
                $('#save-password-button .icon').toggleClass( 'hide' );

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
                            form: $('#user-form-password'),
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
                method  : 'saveUser'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#user-form-password').tigerForm('getFormValues', apiParams );

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
  
    $.fn.accountProfile = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountProfile();
    
})( jQuery );
