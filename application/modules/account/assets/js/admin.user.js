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
 * jQuery Tiger Admin User Plugin
 */

(function($ ){
    
    let Class = {

        userDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initUserDataTable();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initUserDataTable : function () {

            let $datatable = $('#usersDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.userDT = $datatable.DataTable({
                'searching': true,
                'processing': false,
                'serverSide': true,
                'orderMulti': true,
                'order': [[1, 'asc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {

                    $(Class.userDT.column(0).header()).text( json.i18n['DT.USERNAME'] );
                    $(Class.userDT.column(1).header()).text( json.i18n['DT.USER_DISPLAY_NAME'] );
                    $(Class.userDT.column(2).header()).text( json.i18n['DT.EMAIL'] );
                    $(Class.userDT.column(3).header()).text( json.i18n['DT.FIRST_NAME'] );
                    $(Class.userDT.column(4).header()).text( json.i18n['DT.LAST_NAME'] );
                    $(Class.userDT.column(5).header()).text( json.i18n['DT.ROLE'] );
                    $(Class.userDT.column(6).header()).text( json.i18n['DT.ACTIONS'] );
                    $(Class.userDT.column(7).header()).text( json.i18n['DT.USER_ID'] );
                    $(Class.userDT.column(8).header()).text( json.i18n['DT.MIDDLE_NAME'] );
                    $(Class.userDT.column(9).header()).text( json.i18n['DT.ACTIVE'] );
                    $(Class.userDT.column(10).header()).text( json.i18n['DT.DELETED'] );

                    setTimeout( function () {
                        One.block('state_normal', $block);
                    }, 1000);

                },
                'ajax': {
                    'url': '/api',
                    'type': 'POST',
                    'dataType': 'json',
                    'dataSrc': 'data',
                    'data': {
                        service: 'account:admin',
                        method: 'getAdminUsersDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.USERNAME',
                    'name': 'username',
                    'data': 'username',
                },  {
                    'title': 'DT.USER_DISPLAY_NAME',
                    'name': 'user_display_name',
                    'data': 'user_display_name',
                }, {
                    'title': 'DT.EMAIL',
                    'name': 'email',
                    'data': 'email'
                }, {
                    'title': 'DT.FIRST_NAME',
                    'name': 'first_name',
                    'data': 'first_name',
                }, {
                    'title': 'DT.LAST_NAME',
                    'name': 'last_name',
                    'data': 'last_name',
                }, {
                    'title': 'DT.ROLE',
                    'name': 'role',
                    'data': 'role',
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '280px',
                    'render': Class._buildControls,
                }, {
                    'title': 'DT.USER_ID',
                    'name': 'user_id',
                    'data': 'user_id',
                    'visible': false
                }, {
                    'title': 'DT.MIDDLE_NAME',
                    'name': 'middle_name',
                    'data': 'middle_name',
                    'visible': false
                }, {
                    'title': 'DT.ACTIVE',
                    'name': 'active',
                    'data': 'active',
                    'class': 'active',
                    'visible': false
                }, {
                    'title': 'DT.DELETED',
                    'name': 'deleted',
                    'data': 'deleted',
                    'class': 'deleted',
                    'visible': false
                }]
            });

            Class.userDT.on('draw', function ( event, settings ) {
                One.helpers('core-bootstrap-tooltip');
            });

        },

        _buildControls : function ( data, type, row, meta ) {

            let html = '';

            $( data.controls ).each(function (i, el) {

                if ( el.type === 'icon' ) {
                    html += $('<i>')
                        .attr('data-id', el.id)
                        .attr('data-value', el.value)
                        .attr('class', el.class)
                        .attr('title', el.title)
                        .attr('data-toggle', 'tooltip')
                        .attr('data-animation', 'true')
                        .attr('data-placement', 'bottom')
                        .attr('data-delay', '{ "show": 2000, "hide": 100 }')
                        .prop('outerHTML');
                }

                if ( el.type === 'button' ) {
                    html += $('<button>')
                        .attr('data-id', el.id)
                        .attr('data-value', el.value)
                        .attr('class', el.class)
                        .attr('title', el.title)
                        .prop('outerHTML');
                }

            });

            return html;

        },

        _initControls : function () {

            $('#add-user').on( 'click', Class._add );
            $('#save-user-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

            $().tigerDOM('initToggleControls');

            // Admin's can set passwords can be set to anything, so don't bother validating. //
            $('#user-form #password').off( 'blur.autovalidate' );

            Class._initRoleSelect2();
            Class._initTypeTitleSelect2();
            Class._initTypeSuffixSelect2();
            Class._initTypeHearaboutSelect2();
            Class._initReferralOrgSelect2();
            Class._initReferralUserSelect2();

        },

        // Select2 Controls //

        _initRoleSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    order   : 'priority ASC',
                    service : 'account:admin',
                    method  : 'getRoleSelect2List'
                }

                return query;

            }

            $('#user-form #role').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setRoleSelect2 ( role ) {

            if ( role.length === 0 ) { return; }

            let $role = $('#user-form #role');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getRoleSelect2List/search/' + role
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $role.append(option).trigger('change');

            });

        },

        _initTypeTitleSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'title'
                }

                return query;

            }

            $('#user-form #type_title').select2({
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

            let $typeTitle = $('#user-form #type_title');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/' + type_title
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
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'suffix'
                }

                return query;

            }

            $('#user-form #type_suffix').select2({
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

            let $typeSuffix = $('#user-form #type_suffix');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/' + type_suffix
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

        _initTypeHearaboutSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'hearabout',
                    key         : ''
                }

                return query;

            }

            $('#user-form #type_hearabout').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeHearaboutSelect2 ( type_hearabout ) {

            if ( ! type_hearabout ) { return; }

            let $typeHearabout = $('#user-form #type_hearabout');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/hearabout/key/' + type_hearabout
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeHearabout.append(option).trigger('change');

                $typeHearabout.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initReferralOrgSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    service : 'account:admin',
                    method  : 'getOrgSelect2List'
                }

                return query;

            }

            $('#user-form #referral_org_id').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setReferralOrgSelect2 ( referral_org_id ) {

            if ( ! referral_org_id ) { return; }

            let $referralOrgId = $('#user-form #referral_org_id');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getOrgSelect2List/search/' + referral_org_id
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $referralOrgId.append(option).trigger('change');

                $referralOrgId.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initReferralUserSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    service : 'account:admin',
                    method  : 'getUserSelect2List'
                }

                return query;

            }

            $('#user-form #referral_user_id').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setReferralUserSelect2 ( referral_user_id ) {

            if ( ! referral_user_id ) { return; }

            let $referralUserId = $('#user-form #referral_user_id');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getUserSelect2List/search/' + referral_user_id
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $referralUserId.append(option).trigger('change');

                $referralUserId.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        // CRUD Functions //

        _add : function ( event ) {

            $('#add-user-header').removeClass('hide')
            $('#edit-user-header').addClass('hide')
            $('#user-form .form-ids').addClass('hide');
            $('#user-form .boiler-plate').addClass('hide')
            $('#user-form').tigerForm('reset');
            $('#modal-users-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-user-header').addClass('hide');
            $('#edit-user-header').removeClass('hide');
            $('#user-form .boiler-plate').removeClass('hide');
            $('#user-form .form-ids').removeClass('hide');
            $('#user-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#user-form').tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setRoleSelect2( data.data.role );
                    Class._setTypeTitleSelect2( data.data.type_title );
                    Class._setTypeSuffixSelect2( data.data.type_suffix );
                    Class._setTypeHearaboutSelect2( data.data.type_hearabout );

                    $('#user-form #username').attr('data-context', $('#user-form #username').val() );
                    $('#user-form #email').attr('data-context', $('#user-form #email').val() );

                    // $('#user-form .form-ids .user_id').html( data.data.user_id );
                    $('#modal-users-form').modal('show');

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

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'account:admin',
                method  : 'getuser',
                user_id : $(this).attr('data-id')
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

        _update : function ( event ) {

            /**
             * This function is used to persist not entire forms, but merely small
             * pieces of data, typically from datatables. Yes we do send then entire
             * DT row of data ... but don't really have to.
             */

            let $elm = $(this), data = {};

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( parseInt( data.result, 10 ) === 1 ) {

                    /** Update the icon's data-value and class. */

                    if ( $elm.hasClass('active') ) {
                        $elm.attr('data-value', data.data.active);
                        data.data.active = ( parseInt(data.data.active,10) === 1 )
                            ? $elm.removeClass('fa-play').addClass('fa-pause')
                            : $elm.addClass('fa-play').removeClass('fa-pause');
                    }
                    else if ( $elm.hasClass('deleted') ) {
                        $elm.attr('data-value', data.data.deleted);
                        data.data.deleted = ( parseInt(data.data.deleted,10) === 0 )
                            ? $elm.addClass('fa-trash').removeClass('fa-trash-restore')
                            : $elm.removeClass('fa-trash').addClass('fa-trash-restore');
                    }

                }
                else {

                    $( '#page-messages' )
                         .css('overflow', 'hidden')
                         .tigerDOM('change', {
                            content: data.html[0],
                            removeClick: true,
                            removeTimeout: 0
                        });

                }
            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                $( '#page-messages' )
                    .css('overflow', 'hidden')
                    .tigerDOM('change', {
                        content: '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                        removeClick: true,
                        removeTimeout: 0
                    });

            }

            /** Flip the bool before sending to the server. */
            if ( $elm.hasClass('active') ) {
                data.active = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else if ( $elm.hasClass('deleted') ) {
                data.deleted = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else {
                return;
            }

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'account:admin';
            data.method = 'updateUser';
            data.user_id = $elm.attr('data-id');

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

                /* Disable any elements if you like. */
                $('#save-user-button').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#save-user-button .ajax').toggleClass( 'hide' );
                $('#save-user-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                $('#save-user-button').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#save-user-button .ajax').toggleClass( 'hide' );
                $('#save-user-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    $('#modal-users-form').modal('hide');

                    /** Reloads the table with the new data at the page it's currently on. */
                    Class.userDT.ajax.reload( null, false );

                    $('#page-messages').css('overflow', 'hidden').tigerDOM( 'change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#user-form .form-message')
                            .css('overflow', 'hidden')
                            .tigerDOM('change', {
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

                // show general error message
                let oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );
                
            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'account:admin',
                method  : 'saveUser',
                user_id : $('#user-form #user_id').val(),
                active  : ( $('#user-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#user-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#user-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.accountAdminUser = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountAdminUser();
    
})( jQuery );
