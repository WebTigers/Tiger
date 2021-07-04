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
 * jQuery Tiger Admin OrgUser Plugin
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

            $('#save-orguser-button').on( 'click', Class._save );

            $('body').on( 'click', 'table i.orguser', Class._view );

            Class._initOrgUserIdSelect2();
            Class._initOrgIdSelect2();
            Class._initTypeUserRoleSelect2();

        },

        // Select2 Controls //

        _initOrgUserIdSelect2 ( ) {

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 99,
                    order       : 'create_date ASC',
                    service     : 'account:admin',
                    method      : 'getAdminOrgUserSelect2List',
                    user_id     : $('#org-user-form #user_id').val()
                }

                return query;

            }

            $('#org-user-form #org_user_id').select2({
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
                    html += data.text
                    return html;
                },
                templateResult : function ( data ){
                    let html = '<span>';
                    html += ( parseInt(data.primary,10) === 1 ) ? '<i class="fa fa-star"></i> ' : '<i> </i>';
                    html += data.text
                    return html;
                }
            });

            $('#org-user-form #org_user_id')
                .off('select2:select')
                .on('select2:select', Class._edit );

        },

        _initOrgIdSelect2 ( ) {

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 10,
                    order       : 'create_date ASC',
                    service     : 'account:admin',
                    method      : 'getOrgSelect2List'
                }

                return query;

            }

            $('#org-user-form #org_id').select2({
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
                    return '<span>' + data.text + '</span>';
                },
                templateResult : function ( data ){
                    return '<span>' + data.text + '</span>';
                }
            });

        },

        _initTypeUserRoleSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'role',
                    key         : ''
                }

                return query;

            }

            $('#org-user-form #type_user_role').select2({
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

        _setTypeUserRoleSelect2 ( type_user_role ) {

            if ( ! type_user_role ) { return; }

            let $typeUserRole = $('#org-user-form #type_user_role');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/role/key/' + type_user_role
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeUserRole.append(option).trigger('change');

                $typeUserRole.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

                $typeUserRole.tigerForm( 'autoValidate' );

            });

        },

        _setOrgSelect2 ( org_id ) {

            if ( ! org_id ) { return; }

            let $orgId = $('#org-user-form #org_id');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getOrgSelect2List/search/' + org_id
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $orgId.append( option ).trigger( 'change' );

                $orgId.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        // CRUD Functions //

        _resetOrgUser ( ) {

            $('#org-user-form').tigerForm('reset');
            $('#org-user-form #org_id').select2('destroy');
            $('#org-user-form #type_user_role').select2('destroy');
            Class._initOrgIdSelect2();
            Class._initTypeUserRoleSelect2();

        },

        _view : function ( event ) {

            Class._resetOrgUser();
            $('#org-user-form-form #org_user_id').select2('destroy');
            $('#org-user-form-form #org_id').select2('destroy');
            Class._initOrgUserIdSelect2();
            Class._initOrgIdSelect2();
            $('#org-user-form #user_id').val( $(this).attr('data-id') );
            $('#modal-orguser-form').modal('show');

        },

        _edit : function ( event ) {

            $('#org-user-form').find('div.overlay').animate({'opacity': '0'}, 400, function (){
                $(this).css('display','none');
            });

            /** if the value is empty, then it's a new orgUser. Just clear the form and return. */
            if ( ! $('#org-user-form #org_user_id').val() ) {

                Class._resetOrgUser();
                return;

            }

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#org-user-form #type_user_role').tigerForm( 'autoValidateOff' );

                    $('#org-user-form').tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setOrgSelect2( data.data.org_id );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeUserRoleSelect2( data.data.type_user_role );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#org-user-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#org-user-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

            }

            let data = {
                service     : 'account:admin',
                method      : 'getOrgUser',
                org_user_id : $('#org-user-form #org_user_id').val()
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

                    $('#org-user-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#org-user-form .form-message')
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
                            form: 'Account_Form_Contact',
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

                $('#org-user-form .form-message').css('overflow','hidden').tigerDOM( 'change', {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                });
                
            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service         : 'account:admin',
                method          : 'saveOrgUser',
                primary         : ( $('#org-user-form #primary').is(':checked') ) ? 1 : 0,
                active          : ( $('#org-user-form #active').is(':checked') ) ? 1 : 0,
                deleted         : ( $('#org-user-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#org-user-form').tigerForm('getFormValues', apiParams );

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

                    Class._resetOrgUser();
                    $('#org-user-form #org_user_id').select2('destroy');
                    Class._initOrgUserIdSelect2();

                }

                /** Oops, something went wrong ... */

                $( '#org-user-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#org-user-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

            }

            let data = {
                service     : 'account:admin',
                method      : 'removeOrgUser',
                org_user_id : $('#org-user-form #org_user_id').val()
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

        }

    };
  
    $.fn.accountAdminOrgUser = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountAdminOrgUser();
    
})( jQuery );
