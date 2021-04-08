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
 * jQuery Tiger ACL Admin Backup Plugin
 */

(function( $ ){
    
    let Class = {

        backupDT : null,
        confirm : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initBackupDataTable();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initBackupDataTable : function () {

            let $datatable = $('#backupDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.backupDT = $datatable.DataTable({
                'searching': true,
                'processing': false,
                'serverSide': false,
                'orderMulti': false,
                'order': [[2, 'desc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {
                    'DT.FILENAME',
                    $(Class.backupDT.column(0).header()).text( json.i18n['DT.FILENAME'] );
                    $(Class.backupDT.column(1).header()).text( json.i18n['DT.FILESIZE'] );
                    $(Class.backupDT.column(2).header()).text( json.i18n['DT.FILEDATE'] );
                    $(Class.backupDT.column(3).header()).text( json.i18n['DT.FILEPATH'] );
                    $(Class.backupDT.column(4).header()).text( json.i18n['DT.ACTIONS'] );

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
                        service: 'core:admin',
                        method: 'getAdminBackupDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.FILENAME',
                    'name': 'filename',
                    'data': 'filename'
                }, {
                    'title': 'DT.FILESIZE',
                    'name': 'filesize',
                    'data': 'filesize'
                }, {
                    'title': 'DT.FILEDATE',
                    'name': 'filedate',
                    'data': 'filedate'
                }, {
                    'title': 'DT.FILEPATH',
                    'name': 'filepath',
                    'data': 'filepath',
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '150px',
                    'render': Class._buildControls,
                }]
            });

            Class.backupDT.on('draw', function ( event, settings ) {
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

            $('#save-backup-button').on( 'click', Class._backup );
            $('#delete-backup-button').on( 'click', Class._delete );
            $('#restore-backup-button').on( 'click', Class._restore );

            $('#add-backup').on('click', function (){
                $('#modal-backup-form').modal('show');
            });

            $('body').on('click', 'table i.restore', Class._confirmRestore );
            $('body').on('click', 'table i.delete', Class._confirmDelete );

            One.helpers('core-bootstrap-tooltip');

            $().tigerDOM('initToggleControls');

        },

        _backup : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#save-backup-button i.icon').addClass('hide');
                $('#save-backup-button i.ajax').removeClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $('#save-backup-button i.icon').removeClass('hide');
                $('#save-backup-button i.ajax').addClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#modal-backup-form').modal('hide');
                    $('div.block-options [data-tiger-reload-table]').trigger('click');
                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', {
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
                service : 'core:database',
                method  : 'backup',
                filename : $('#filename').val()
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

        _confirmRestore : function ( event ) {

            Class.confirm = $(this).attr('data-id');
            $('#restore-filename').html( Class.confirm );
            $('#modal-backup-confirm-restore').modal('show');

        },

        _restore : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#restore-backup-button i.icon').addClass('hide');
                $('#restore-backup-button i.ajax').removeClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $('#restore-backup-button i.icon').removeClass('hide');
                $('#restore-backup-button i.ajax').addClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.confirm = null;
                    $('#modal-backup-confirm-restore').modal('hide');
                    $('div.block-options [data-tiger-reload-table]').trigger('click');
                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#form-restore-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#form-restore-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'core:database',
                method  : 'restore',
                filename : Class.confirm
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

        _confirmDelete : function ( event ) {

            Class.confirm = $(this).attr('data-id');
            $('#delete-filename').html( Class.confirm );
            $('#modal-backup-confirm-delete').modal('show');

        },

        _delete : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#delete-backup-button i.icon').addClass('hide');
                $('#delete-backup-button i.ajax').removeClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $('#delete-backup-button i.icon').removeClass('hide');
                $('#delete-backup-button i.ajax').addClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.confirm = null;
                    $('#modal-backup-confirm-delete').modal('hide');
                    $('div.block-options [data-tiger-reload-table]').trigger('click');
                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#form-delete-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#form-delete-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'core:admin',
                method  : 'deleteBackup',
                filename : Class.confirm
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
  
    $.fn.coreAdminBackup = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().coreAdminBackup();
    
})( jQuery );
