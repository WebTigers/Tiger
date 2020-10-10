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
 * jQuery Tiger Account Admin Org Plugin
 */

(function( $ ){
    
    let Class = {

        orgDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initOrgDataTable();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initOrgDataTable : function () {

            let $datatable = $('#orgsDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block);

            Class.orgDT = $datatable.DataTable({
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

                    $(Class.orgDT.column(0).header()).text( json.i18n['DT.ORGNAME'] );
                    $(Class.orgDT.column(1).header()).text( json.i18n['DT.COMPANY_NAME'] );
                    $(Class.orgDT.column(2).header()).text( json.i18n['DT.DISPLAY_NAME'] );
                    $(Class.orgDT.column(3).header()).text( json.i18n['DT.ORG_DESCRIPTION'] );
                    $(Class.orgDT.column(4).header()).text( json.i18n['DT.REFERRAL_CODE'] );
                    $(Class.orgDT.column(5).header()).text( json.i18n['DT.ACTIONS'] );
                    $(Class.orgDT.column(6).header()).text( json.i18n['DT.ORG_ID'] );
                    $(Class.orgDT.column(7).header()).text( json.i18n['DT.PARENT_ORG_ID'] );
                    $(Class.orgDT.column(8).header()).text( json.i18n['DT.TYPE_ORG'] );
                    $(Class.orgDT.column(9).header()).text( json.i18n['DT.DOMAIN'] );
                    $(Class.orgDT.column(10).header()).text( json.i18n['DT.ACTIVE'] );
                    $(Class.orgDT.column(11).header()).text( json.i18n['DT.DELETED'] );

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
                        method: 'getAdminOrgsDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.ORGNAME',
                    'name': 'orgname',
                    'data': 'orgname',
                },  {
                    'title': 'DT.COMPANY_NAME',
                    'name': 'company_name',
                    'data': 'company_name',
                }, {
                    'title': 'DT.DISPLAY_NAME',
                    'name': 'org_display_name',
                    'data': 'org_display_name',
                }, {
                    'title': 'DT.ORG_DESCRIPTION',
                    'name': 'org_description',
                    'data': 'org_description'
                }, {
                    'title': 'DT.REFERRAL_CODE',
                    'name': 'referral_code',
                    'data': 'referral_code'
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '230px',
                    'render': Class._buildControls,
                }, {
                    'title': 'DT.ORG_ID',
                    'name': 'org_id',
                    'data': 'org_id',
                    'visible': false
                }, {
                    'title': 'DT.PARENT_ORG_ID',
                    'name': 'parent_org_id',
                    'data': 'parent_org_id',
                    'visible': false
                }, {
                    'title': 'DT.TYPE_ORG',
                    'name': 'type_org',
                    'data': 'type_org',
                    'visible': false
                }, {
                    'title': 'DT.DOMAIN',
                    'name': 'domain',
                    'data': 'domain',
                    'visible': false
                }, {
                    'title': 'DT.ACTIVE',
                    'name': 'actIve',
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

            Class.orgDT.on('draw', function ( event, settings ) {
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

            $('#add-org').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

            $().tigerDOM('initToggleControls');

            Class._initParentOrgsSelect2();
            Class._initTypeHearaboutSelect2();
            Class._initReferralOrgsSelect2();
            Class._initReferralUserSelect2();

        },

        _initParentOrgsSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 1,
                    limit   : 10,
                    service : 'account:admin',
                    method  : 'getOrgSelect2List'
                }

                return query;

            }

            $('#org-form #parent_org_id').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _initTypeHearaboutSelect2 ( ) {

            function data( params ) {

                let query = {
                    service : 'account:admin',
                    method  : 'getTypeSelect2List',
                    type    : 'hearabout'
                }

                return query;

            }

            $('#org-form #type_hearabout').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _initReferralOrgsSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 1,
                    limit   : 10,
                    service : 'account:admin',
                    method  : 'getOrgSelect2List'
                }

                return query;

            }

            $('#org-form #referral_org_id').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _initReferralUserSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 1,
                    limit   : 10,
                    service : 'account:admin',
                    method  : 'getUserSelect2List'
                }

                return query;

            }

            $('#org-form #referral_user_id').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _add : function ( event ) {

            $('#add-org-header').removeClass('hide')
            $('#edit-org-header').addClass('hide')
            $('#org-form .form-ids').addClass('hide');
            $('#org-form .boiler-plate').addClass('hide')
            $('#org-form').tigerForm('reset');
            $('#modal-orgs-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-org-header').addClass('hide');
            $('#edit-org-header').removeClass('hide');
            $('#org-form .boiler-plate').removeClass('hide');
            $('#org-form .form-ids').removeClass('hide');
            $('#org-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#org-form').tigerForm('setFormValues', data.data );
                    $('#org-form .form-ids .org_id').html( data.data.org_id );
                    $('#modal-orgs-form').modal('show');

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
                service : 'account:admin',
                method  : 'getOrg',
                org_id : $(this).attr('data-id')
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

                    /** Update the icon and the row's value. */

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
            data.method = 'updateOrg';
            data.org_id = $elm.attr('data-id');

            /** API params tell Tiger what service will be processing the data. */

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

                    $('#org-form .form-message').css('overflow', 'hidden').tigerDOM('insert', {
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
                            form: 'Account_Form_Org',
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
                service : 'account:admin',
                method  : 'saveOrg',
                org_id  : $('#org-form #org_id').val(),
                active  : ( $('#org-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#org-form #deleted').is(':checked') ) ? 1 : 0
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
            
        }

    };
  
    $.fn.accountAdminOrg = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountAdminOrg();
    
})( jQuery );
