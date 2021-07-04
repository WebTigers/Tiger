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
                'order': [[1, 'asc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {

                    $(Class.messageDT.column(0).header()).text( json.i18n['DT.TITLE'] );
                    $(Class.messageDT.column(1).header()).text( json.i18n['DT.MESSAGE'] );
                    $(Class.messageDT.column(2).header()).text( json.i18n['DT.TYPE_MESSAGE_STATUS'] );
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
                    'title': 'DT.TITLE',
                    'name': 'title',
                    'data': 'title'
                }, {
                    'title': 'DT.MESSAGE',
                    'name': 'message',
                    'data': 'message'
                }, {
                    'title': 'DT.TYPE_MESSAGE_STATUS',
                    'name': 'type_message_status',
                    'data': 'type_message_status'
                }, {
                    'title': 'DT.ROUTE',
                    'name': 'route',
                    'data': 'route'
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

            $('#add-message').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

            $().tigerDOM('initToggleControls');

            $('#message-form #target').select2({
                minimumResultsForSearch: -1
            })
                .on('change', Class._getTemplate )
                .on('change', Class._showTargetFields );

            $('#message-form #format').select2({
                minimumResultsForSearch: -1
            }).on('change', Class._getTemplate );

            $('#message-form #status').select2({
                minimumResultsForSearch: -1
            });

            $('#message-form #locale').select2({
                minimumResultsForSearch: -1
            });

            $('#message-form #dismissible').on('change', Class._getTemplate );
            $('#message-form #title')
                .on('change', Class._getTemplate )
                .on('keyup', function ( event ){
                $('#message-example h3').html( $(this).val() );
            });
            ;
            $('#message-form #message')
                .on('change', Class._getTemplate )
                .on('keyup', function ( event ){
                    $('#message-example p').html( $(this).val() );
                });

            $('#message-form #icon_css').tigerIconSelect();
            $('#message-form #icon_css').on('change', Class._getTemplate );

            $('#message-form #start_date, #message-form #end_date').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                autoUpdateInput: false,
                locale: {
                    format: 'Y-MM-DD hh:mm A',
                    cancelLabel: 'Clear'
                }
            }).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('Y-MM-DD hh:mm A'));
            });

            Class._initUsersSelect2();
            Class._initRolesSelect2();
            Class._initOrgsSelect2();
            Class._initTypeSuffixSelect2();

        },

        // Control Functions //

        _getTemplate : function ( event ) {

            let html = '';

            let data = {
                service     : 'message:admin',
                method      : 'getMessageTemplate',
                target      : $('#message-form #target').val(),
                format      : $('#message-form #format').val(),
                icon_css    : $('#message-form #icon_css').val(),
                message     : $('#message-form #message').val(),
                title       : $('#message-form #title').val(),
                dismissible : ( $('#message-form #dismissible').is(':checked') ) ? 1 : 0,
            };

            if ( data.target && data.format ) {

                $.ajax({
                    type        : 'POST',
                    dataType    : "json",
                    url         : '/api',
                    data        : data
                }).then( function ( data ) {

                    $('#message-example').tigerDOM('change', {
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

        _initTypeSuffixSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'message'
                }

                return query;

            }

            $('#message-form #type_status').select2({
                minimumResultsForSearch: -1,
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeSuffixSelect2 ( type_status ) {

            if ( ! type_suffix ) { return; }

            let $typeSuffix = $('#message-form #type_status');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/' + type_status
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

        _getUserCount : function ( event ) {

            let data = {
                service     : 'account:admin',
                method      : 'getUserCount',
                send_users  : $('#message-form #send_users').val(),
                send_roles  : $('#message-form #send_roles').val(),
                send_orgs   : $('#message-form #send_orgs').val(),
            };

            $.ajax({
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


        _setUsersSelect2 : function ( users ) {

            if ( role.length === 0 ) { return; }

            let $listUsers = $('#message-form #send_users');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getUserSelect2List/search/' + list_users
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $listUsers.append(option).trigger('change');

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

        // Message CRUD Functions //

        _add : function ( event ) {

            $('#add-message-header').removeClass('hide')
            $('#edit-message-header').addClass('hide')
            $('#message-form .boiler-plate').addClass('hide')
            $('#message-form').tigerForm('reset');
            $('#modal-messages-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-message-header').addClass('hide')
            $('#edit-message-header').removeClass('hide')
            $('#message-form .boiler-plate').removeClass('hide')
            $('#message-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#message-form').tigerForm('setFormValues', data.data );
                    $('#modal-messages-form').modal('show');

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'insert', {
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

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

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

                    $('#message-form .form-message').css('overflow', 'hidden').tigerDOM('insert', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#page-signup-form .form-message')
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
                            form: 'Dev_Form_Message',
                            element: null,
                            messages: []
                        };

                        $.each(data.messages, function (el, msgObj) {

                            // console.log( el, msgObj );

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

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );
                
            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'message:admin',
                method  : 'saveMessage',
                active  : ( $('#message-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#message-form #deleted').is(':checked') ) ? 1 : 0
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
