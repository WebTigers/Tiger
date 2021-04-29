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
 * jQuery Tiger DEV Admin Register Plugin
 */

(function( $ ){
    
    let Class = {

        registationsDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initRegistrationsDataTable();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initRegistrationsDataTable : function () {

            let $datatable = $('#registrationsDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.resgistrationsDT = $datatable.DataTable({
                'searching': true,
                'processing': false,
                'serverSide': true,
                'orderMulti': true,
                'order': [[4, 'desc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {

                    $(Class.resgistrationsDT.column(0).header()).text( json.i18n['DT.NAME'] );
                    $(Class.resgistrationsDT.column(1).header()).text( json.i18n['DT.COMPANY_NAME'] );
                    $(Class.resgistrationsDT.column(2).header()).text( json.i18n['DT.EMAIL'] );
                    $(Class.resgistrationsDT.column(3).header()).text( json.i18n['DT.COUNTRY'] );
                    $(Class.resgistrationsDT.column(4).header()).text( json.i18n['DT.CREATE_DATE'] );
                    $(Class.resgistrationsDT.column(5).header()).text( json.i18n['DT.ACTIONS'] );

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
                        service: 'register:admin',
                        method: 'getAdminRegistrationsDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.NAME',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'render': Class._buildName,
                }, {
                    'title': 'DT.COMPANY_NAME',
                    'name': 'company_name',
                    'data': 'company_name'
                }, {
                    'title': 'DT.EMAIL',
                    'name': 'email',
                    'data': 'email'
                }, {
                    'title': 'DT.COUNTRY',
                    'name': 'country',
                    'data': 'country'
                }, {
                    'title': 'DT.CREATE_DATE',
                    'name': 'create_date',
                    'data': 'create_date'
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '200px',
                    'render': Class._buildControls,
                }, {
                    'title': 'DT.REGISTER_ID',
                    'name': 'register_id',
                    'data': 'register_id',
                    'visible': false
                }, {
                    'title': 'DT.SUBSCRIBE',
                    'name': 'subscribe',
                    'data': 'subscribe',
                    'class': 'subscribe',
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

            Class.resgistrationsDT.on('draw', function ( event, settings ) {
                One.helpers('core-bootstrap-tooltip');
            });

        },

        _buildName : function ( data, type, row, meta ) {

            let html = data.first_name + ' ' + data.last_name;

            return html;

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

            $('#add-register').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.subscribe, table i.active, table i.deleted', Class._update );

            $( '#country' ).select2({
                'minimumResultsForSearch' : 5
            });

            $().tigerDOM('initToggleControls');

        },

        _add : function ( event ) {

            $('#add-register-header').removeClass('hide');
            $('#edit-register-header').addClass('hide');
            $('#register-form .boiler-plate').addClass('hide');
            $('#register-form').tigerForm('reset');
            $('#modal-register-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-register-header').addClass('hide');
            $('#edit-register-header').removeClass('hide');
            $('#register-form .boiler-plate').removeClass('hide');
            $('#register-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#register-form').tigerForm('setFormValues', data.data );
                    $('#modal-register-form').modal('show');

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
                service : 'register:admin',
                method  : 'getRegistration',
                register_id : $(this).attr('data-id')
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

                    if ( $elm.hasClass('subscribe') ) {
                        $elm.attr('data-value', data.data.subscribe);
                        data.data.subscribe = ( parseInt(data.data.subscribe,10) === 1 )
                            ? $elm.removeClass('fa-envelope').addClass('fa-envelope-open-text')
                            : $elm.addClass('fa-envelope').removeClass('fa-envelope-open-text');
                    }
                    else if ( $elm.hasClass('active') ) {
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
            if ( $elm.hasClass('subscribe') ) {
                data.subscribe = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else if ( $elm.hasClass('active') ) {
                data.active = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else if ( $elm.hasClass('deleted') ) {
                data.deleted = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else {
                return;
            }

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'register:admin';
            data.method = 'updateRegistration';
            data.register_id = $elm.attr('data-id');

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

                    $('#register-form .form-message').css('overflow', 'hidden').tigerDOM('insert', {
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
                            form: 'Register_Form_Register',
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
                service : 'register:admin',
                method  : 'saveRegistration',
                subscribe  : ( $('#register-form #subscribe').is(':checked') ) ? 1 : 0,
                active  : ( $('#register-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#register-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#register-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.registerAdminRegister = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().registerAdminRegister();
    
})( jQuery );
