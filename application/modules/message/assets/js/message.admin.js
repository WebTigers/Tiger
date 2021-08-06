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
 * jQuery Tiger Message Admin Plugin
 */

(function( $ ){

    let Class = {

        messageDT : null,

        promiseUsers : [],
        promiseRoles : [],
        promiseOrgs  : [],

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initMessageDataTable();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initMessageDataTable : function () {

            let $datatable = $('#messagesDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.messageDT = $datatable.DataTable({
                'searching': true,
                'processing': false,
                'serverSide': true,
                'orderMulti': true,
                'order': [[0, 'asc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {

                    $(Class.messageDT.column(0).header()).text( json.i18n['DT.MESSAGE'] );
                    $(Class.messageDT.column(1).header()).text( json.i18n['DT.TARGET'] );
                    $(Class.messageDT.column(2).header()).text( json.i18n['DT.TYPE_STATUS'] );
                    $(Class.messageDT.column(3).header()).text( json.i18n['DT.ROUTE'] );
                    $(Class.messageDT.column(4).header()).text( json.i18n['DT.LOCALE'] );
                    $(Class.messageDT.column(5).header()).text( json.i18n['DT.START_DATE'] );
                    $(Class.messageDT.column(6).header()).text( json.i18n['DT.END_DATE'] );
                    $(Class.messageDT.column(7).header()).text( json.i18n['DT.ACTIONS'] );
                    $(Class.messageDT.column(8).header()).text( json.i18n['DT.MESSAGE_ID'] );
                    $(Class.messageDT.column(9).header()).text( json.i18n['DT.ACTIVE'] );
                    $(Class.messageDT.column(10).header()).text( json.i18n['DT.DELETED'] );

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
                        service: 'message:admin',
                        method: 'getAdminMessagesDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.MESSAGE',
                    'name': 'message',
                    'data': 'rendered'
                }, {
                    'title': 'DT.TARGET',
                    'name': 'target',
                    'data': 'target'
                }, {
                    'title': 'DT.TYPE_STATUS',
                    'name': 'type_status',
                    'data': 'type_status'
                }, {
                    'title': 'DT.ROUTE',
                    'name': 'route',
                    'data': 'route',
                    'visible': false
                }, {
                    'title': 'DT.LOCALE',
                    'name': 'locale',
                    'data': 'locale'
                }, {
                    'title': 'DT.START_DATE',
                    'name': 'start_date',
                    'data': 'start_date'
                }, {
                    'title': 'DT.END_DATE',
                    'name': 'end_date',
                    'data': 'end_date'
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '150px',
                    'render': Class._buildControls,
                }, {
                    'title': 'DT.MESSAGE_ID',
                    'name': 'message_id',
                    'data': 'message_id',
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

            Class.messageDT.on('draw', function ( event, settings ) {
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

            $('#add-message').on('click', Class._add);
            $('#save-button').on('click', Class._save);

            $('body').on('click', 'table i.edit', Class._edit);
            $('body').on('click', 'table i.active, table i.deleted', Class._update);

            $().tigerDOM('initToggleControls');

            $('#message-form #dismissible').on('change', Class._getTemplate);
            $('#message-form #title')
                .on('change', Class._getTemplate)
                .on('keyup', function (event) {
                    $('#message-preview h3').html($(this).val());
                });

            $('#message-form #message')
                .on('change', Class._getTemplate)
                .on('keyup', function (event) {
                    $('#message-preview p').html($(this).val());
                });

            $('#message-form #icon_class').tigerIconSelect();
            $('#message-form #icon_class').on('change', Class._getTemplate);

            $('#message-form #start_date, #message-form #end_date').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                autoUpdateInput: false,
                locale: {
                    format: 'Y-MM-DD hh:mm A',
                    cancelLabel: 'Clear'
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('Y-MM-DD hh:mm A'));
            });

            Class._initSelects();

        },

        _initSelects : function ( ) {

            $('#message-form #target').select2({
                minimumResultsForSearch: -1
            }).on('change', Class._getTemplate)
              .on('change', Class._showTargetFields);

            $('#message-form #format').select2({
                minimumResultsForSearch: -1
            }).on('change', Class._getTemplate );

            $('#message-form #type_status').select2({
                minimumResultsForSearch: -1
            });

            $('#message-form #locale').select2({
                minimumResultsForSearch: -1
            });

            Class._initLocaleSelect2();

            Class._initUsersSelect2();
            Class._initRolesSelect2();
            Class._initOrgsSelect2();

        },

        _resetSelects : function () {

            $('#message-form #target').select2('destroy').val('');
            $('#message-form #format').select2('destroy').val('');
            $('#message-form #type_status').select2('destroy').val('');

            $('#message-form #locale').select2('destroy').val('');
            $('#message-form #icon_class').tigerIconSelect('reset');

            $('#message-form #send_users').select2('destroy').val('');
            $('#message-form #send_roles').select2('destroy').val('');
            $('#message-form #send_orgs').select2('destroy').val('');

            Class._initSelects();

        },

        // Control Functions //

        _getTemplate : function ( event ) {

            let html = '';

            let data = {
                service     : 'message:admin',
                method      : 'getMessageTemplate',
                target      : $('#message-form #target').val(),
                format      : $('#message-form #format').val(),
                icon_class  : $('#message-form #icon_class').val(),
                message     : $('#message-form #message').val(),
                title       : $('#message-form #title').val(),
                dismissible : ( $('#message-form #dismissible').is(':checked') ) ? 1 : 0,
                link        : $('#message-form #link').val(),
                link_new    : ( $('#message-form #link_new').is(':checked') ) ? 1 : 0,
                start_date  : $('#message-form #start_date').val(),
                message_id  : $('#message-form #message_id').val(),
                wrapper     : true
        };

            if ( data.target && data.format ) {

                $.ajax({
                    type        : 'POST',
                    dataType    : "json",
                    url         : '/api',
                    data        : data
                }).then( function ( data ) {

                    $('#message-preview').tigerDOM('change', {
                        content : data.data
                    });

                });

            }

        },

        _initUsersSelect2 : function ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    order   : 'username ASC',
                    service : 'account:admin',
                    method  : 'getUserSelect2List'
                }

                return query;

            }

            $('#message-form #send_users').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            }).on('change', Class._getUserCount );

        },

        _setUsersSelect2 ( send_users, resolve, reject ) {

            if ( ! send_users ) { return; }

            let $sendUsers = $('#message-form #send_users');

            let params = {
                service : 'account:admin',
                method  : 'getUserSelect2List',
                search  : send_users
            };

            $.ajax({
                type        : 'POST',
                dataType    : "json",
                url         : '/api/',
                data        : params
            }).then( function ( data ) {

                $.each( data.results, function ( i, el ) {

                    let option = new Option( data.results[i].text, data.results[i].id, true, true);
                    $sendUsers.append(option);

                });

                $sendUsers.trigger({
                    type: 'select2:select',
                    params: {
                        data: data.results
                    }
                });

                resolve( data );

            });

        },

        _initRolesSelect2 : function ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    order   : 'rolename ASC',
                    service : 'account:admin',
                    method  : 'getRoleSelect2List'
                }

                return query;

            }

            $('#message-form #send_roles').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            }).on('change', Class._getUserCount );

        },

        _setRolesSelect2 ( send_roles, resolve, reject ) {

            if ( ! send_roles ) { return; }

            let $sendRoles = $('#message-form #send_roles');

            let params = {
                service : 'account:admin',
                method  : 'getRoleSelect2List',
                search  : send_roles
            };

            $.ajax({
                type        : 'POST',
                dataType    : "json",
                url         : '/api/',
                data        : params
            }).then( function ( data ) {

                $.each( data.results, function ( i, el ) {

                    let option = new Option( data.results[i].text, data.results[i].id, true, true);
                    $sendRoles.append(option);

                });

                $sendRoles.trigger({
                    type: 'select2:select',
                    params: {
                        data: data.results
                    }
                });

                resolve( data );

            });

        },

        _initOrgsSelect2 : function ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    order   : 'orgname ASC',
                    service : 'account:admin',
                    method  : 'getOrgSelect2List'
                }

                return query;

            }

            $('#message-form #send_orgs').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            }).on('change', Class._getUserCount );

        },

        _setOrgsSelect2 ( send_orgs, resolve, reject ) {

            if ( ! send_orgs ) { return; }

            let $sendOrgs = $('#message-form #send_orgs');

            let params = {
                service : 'account:admin',
                method  : 'getOrgSelect2List',
                search  : send_orgs
            };

            $.ajax({
                type        : 'POST',
                dataType    : "json",
                url         : '/api/',
                data        : params
            }).then( function ( data ) {

                $.each( data.results, function ( i, el ) {

                    let option = new Option( data.results[i].text, data.results[i].id, true, true);
                    $sendOrgs.append(option);

                });

                $sendOrgs.trigger({
                    type: 'select2:select',
                    params: {
                        data: data.results
                    }
                });

                resolve( data );

            });

        },

        _initLocaleSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    order   : 'locale ASC',
                    service : 'message:admin',
                    method  : 'getMessageLocaleSelect2List'
                }

                return query;

            }

            $('#message-form #locale').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setLocaleSelect2 ( locale ) {

            if ( ! locale ) { return; }

            let $locale = $('#message-form #locale');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/message:admin/method/getMessageLocaleSelect2List/search/' + locale
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $locale.append(option);

                $locale.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        // Message Functions //

        _getUserCount : function ( event ) {

            let data = {
                service     : 'message:admin',
                method      : 'getUserCount',
                send_users  : $('#message-form #send_users').val(),
                send_roles  : $('#message-form #send_roles').val(),
                send_orgs   : $('#message-form #send_orgs').val(),
            };

            Class.jqXHRCount = $.ajax({
                type        : 'POST',
                dataType    : "json",
                url         : '/api',
                data        : data
            }).then( function ( data ) {

                $('#user-count-message').tigerDOM('change', {
                    content : data.html[0]
                });

            });

        },

        _showTargetFields : function ( event ) {

            $( '#notification-wrapper, #alert-wrapper' ).hide();

            if ( $('#message-form #target').val() === 'message:notification' ) {
                $('#notification-wrapper').show();
            }
            else if ( $('#message-form #target').val() === 'message:alert' ) {
                $('#alert-wrapper').show();
            }

        },

        _resetForm : function ( ) {

            Class._resetSelects();

            $('#message-form .boiler-plate').addClass('hide')
            $('#message-form').tigerForm('reset');
            $('.nav-tabs li:first-child a').tab('show');

            $('#user-count-message').children().remove();
            Class._resetMessageExample();

        },

        _resetMessageExample ( ) {

            $('#message-preview').children().remove();

        },

        _processGetUserCount ( data ) {

            Class.promiseUsers = new Promise((resolve, reject) => {
                Class._setUsersSelect2( data.data.send_users, resolve, reject );
            });

            Class.promiseRoles = new Promise((resolve, reject) => {
                Class._setRolesSelect2( data.data.send_roles, resolve, reject );
            });

            Class.promiseOrgs = new Promise((resolve, reject) => {
                Class._setOrgsSelect2( data.data.send_orgs, resolve, reject );
            });

            Promise.all([ Class.promiseUsers, Class.promiseRoles, Class.promiseOrgs ] ).then( (values) => {
                Class._getUserCount();
            });

        },

        // Message CRUD Functions //

        _add : function ( event ) {

            Class._resetForm();
            $('#add-message-header').removeClass('hide')
            $('#edit-message-header').addClass('hide')

            $('#modal-messages-form').modal('show');

        },

        _edit : function ( event ) {

            Class._resetForm();
            $('#add-message-header').addClass('hide')
            $('#edit-message-header').removeClass('hide')

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#message-form').tigerForm('setFormValues', data.data );
                    $('#message-form #icon_class').trigger('change');
                    $('#message-preview').append( data.data.rendered );

                    Class._setLocaleSelect2( data.data.locale );
                    Class._processGetUserCount( data );

                    $('#modal-messages-form').modal('show');

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
                service : 'message:admin',
                method  : 'getMessage',
                message_id : $(this).attr('data-id')
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
            data.service = 'message:admin';
            data.method = 'updateMessage';
            data.message_id = $elm.attr('data-id');

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
                $('#save-button').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#save-button .ajax').toggleClass( 'hide' );
                $('#save-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                $('#save-button').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#save-button .ajax').toggleClass( 'hide' );
                $('#save-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    /** Update the datatable with the new data. */
                    Class.messageDT.row( $( 'table tr#' + data.message_id )[0] ).data( data.data ).draw();

                    /** Show the success message. */
                    $('#message-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#message-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                                content: data.html[0],
                                removeClick: true,
                                removeTimeout: 0
                            });

                    }

                    if ( data.messages ) {

                        let msgData = {
                            result: 0,
                            form: 'Message_Form_Message',
                            element: null,
                            messages: []
                        };

                        $.each(data.messages, function (el, msgObj) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each(msgObj, function (errName, errMsg) {
                                console.log(errName, errMsg);
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
                service     : 'message:admin',
                method      : 'saveMessage',
                link_new    : ( $('#message-form #link_new').is(':checked') ) ? 1 : 0,
                active      : ( $('#message-form #active').is(':checked') ) ? 1 : 0,
                deleted     : ( $('#message-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#message-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.messageAdmin = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().messageAdmin();
    
})( jQuery );
