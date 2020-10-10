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
 * jQuery Tiger ACL Admin Resource Plugin
 */

(function( $ ){
    
    let Class = {

        resourceDT : null,
        staticResourceDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initResourceDataTable();
                Class._initControls();
                Class._initStaticResourceDataTable();

            });

        },

        // Admin Functions //

        _initResourceDataTable : function () {

            let $datatable = $('#resourcesDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.resourceDT = $datatable.DataTable({
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

                    $(Class.resourceDT.column(0).header()).text( json.i18n['DT.MODULE'] );
                    $(Class.resourceDT.column(1).header()).text( json.i18n['DT.RESOURCE_NAME'] );
                    $(Class.resourceDT.column(2).header()).text( json.i18n['DT.RESOURCE_DESCRIPTION'] );
                    $(Class.resourceDT.column(3).header()).text( json.i18n['DT.RESOURCE'] );
                    $(Class.resourceDT.column(4).header()).text( json.i18n['DT.PRIVILEGE'] );
                    $(Class.resourceDT.column(5).header()).text( json.i18n['DT.RESOURCE_ID'] );
                    $(Class.resourceDT.column(6).header()).text( json.i18n['DT.ACTIVE'] );
                    $(Class.resourceDT.column(7).header()).text( json.i18n['DT.DELETED'] );

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
                        service: 'acl:admin',
                        method: 'getAdminResourcesDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.MODULE',
                    'name': 'module_name',
                    'data': 'module_name'
                }, {
                    'title': 'DT.RESOURCE_NAME',
                    'name': 'resource_name',
                    'data': 'resource_name'
                }, {
                    'title': 'DT.RESOURCE_DESCRIPTION',
                    'name': 'resource_description',
                    'data': 'resource_description'
                }, {
                    'title': 'DT.RESOURCE',
                    'name': 'resource',
                    'data': 'resource'
                }, {
                    'title': 'DT.PRIVILEGE',
                    'name': 'privilege',
                    'data': 'privilege'
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '150px',
                    'render': Class._buildControls,
                }, {
                    'title': 'DT.RESOURCE_ID',
                    'name': 'resource_id',
                    'data': 'resource_id',
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

            Class.resourceDT.on('draw', function ( event, settings ) {
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

            $('#add-resource').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

            $().tigerDOM('initToggleControls');

        },

        _add : function ( event ) {

            $('#add-resource-header').removeClass('hide')
            $('#edit-resource-header').addClass('hide')
            $('#resource-form .boiler-plate').addClass('hide')
            $('#resource-form').tigerForm('reset');
            $('#modal-resources-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-resource-header').addClass('hide')
            $('#edit-resource-header').removeClass('hide')
            $('#resource-form .boiler-plate').removeClass('hide')
            $('#resource-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#resource-form').tigerForm('setFormValues', data.data );
                    $('#modal-resources-form').modal('show');

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
                service : 'acl:admin',
                method  : 'getResource',
                resource_id : $(this).attr('data-id')
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
            data.service = 'acl:admin';
            data.method = 'updateResource';
            data.resource_id = $elm.attr('data-id');

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

                    $('#resource-form .form-message').css('overflow', 'hidden').tigerDOM('insert', {
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
                            form: 'Acl_Form_Resource',
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
                service : 'acl:admin',
                method  : 'saveResource',
                active  : ( $('#resource-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#resource-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#resource-form').tigerForm('getFormValues', apiParams );

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

        _initStaticResourceDataTable : function () {

            let $datatable = $('#staticResourcesDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.staticResourceDT = $datatable.DataTable({
                'searching': true,
                'processing': false,
                'serverSide': false,
                'orderMulti': true,
                'order': [[0, 'asc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {

                    $(Class.staticResourceDT.column(0).header()).text( json.i18n['DT.MODULE'] );
                    $(Class.staticResourceDT.column(1).header()).text( json.i18n['DT.RESOURCE_NAME'] );
                    $(Class.staticResourceDT.column(2).header()).text( json.i18n['DT.RESOURCE_DESCRIPTION'] );
                    $(Class.staticResourceDT.column(3).header()).text( json.i18n['DT.RESOURCE'] );
                    $(Class.staticResourceDT.column(4).header()).text( json.i18n['DT.PRIVILEGE'] );

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
                        service: 'acl:admin',
                        method: 'getAdminStaticResourcesDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.MODULE',
                    'name': 'module_name',
                    'data': 'module_name'
                }, {
                    'title': 'DT.RESOURCE_NAME',
                    'name': 'resource_name',
                    'data': 'resource_name'
                }, {
                    'title': 'DT.RESOURCE_DESCRIPTION',
                    'name': 'resource_description',
                    'data': 'resource_description'
                }, {
                    'title': 'DT.RESOURCE',
                    'name': 'resource',
                    'data': 'resource'
                }, {
                    'title': 'DT.PRIVILEGE',
                    'name': 'privilege',
                    'data': 'privilege'
                }]
            });

        },

    };
  
    $.fn.aclAdminResource = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().aclAdminResource();
    
})( jQuery );
