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
 * jQuery Tiger Admin Package Plugin
 */

(function( $ ){
    
    let Class = {

        packageDT : null,
        packageTypes : ['tiger-module','tiger-theme'],
        confirm : null,

        ajaxQueue : $({}),

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initPackageDataTable();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initPackageDataTable : function () {

            let $datatable = $('#packageDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.packageDT = $datatable.DataTable({
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

                    $(Class.packageDT.column(0).header()).text( json.i18n['DT.PACKAGE_ID'] );
                    $(Class.packageDT.column(1).header()).text( json.i18n['DT.PACKAGE_NAME'] );
                    $(Class.packageDT.column(2).header()).text( json.i18n['DT.PACKAGE_TARGET_VERSION'] );
                    $(Class.packageDT.column(3).header()).text( json.i18n['DT.PACKAGE_DESCRIPTION'] );
                    $(Class.packageDT.column(4).header()).text( json.i18n['DT.PACKAGE_REQUIRED'] );
                    $(Class.packageDT.column(5).header()).text( json.i18n['DT.PACKAGE_VERSION'] );
                    $(Class.packageDT.column(6).header()).text( json.i18n['DT.PACKAGE_LATEST'] );
                    $(Class.packageDT.column(7).header()).text( json.i18n['DT.PACKAGE_REPO_TYPE'] );
                    $(Class.packageDT.column(8).header()).text( json.i18n['DT.PACKAGE_REPO_URL'] );
                    $(Class.packageDT.column(9).header()).text( json.i18n['DT.ACTIONS'] );

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
                        service: 'package:package',
                        method: 'getAdminPackagesDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.PACKAGE_ID',
                    'name': 'package_id',
                    'data': 'package_id',
                    'visible': false
                }, {
                    'title': 'DT.PACKAGE_NAME',
                    'name': 'name',
                    'data': 'name'
                }, {
                    'title': 'DT.PACKAGE_TARGET_VERSION',
                    'name': 'target_version',
                    'data': 'target_version'
                }, {
                    'title': 'DT.PACKAGE_DESCRIPTION',
                    'name': 'description',
                    'data': 'description'
                }, {
                    'title': 'DT.PACKAGE_REQUIRED',
                    'name': 'required',
                    'data': 'required',
                    'visible': false
                }, {
                    'title': 'DT.PACKAGE_VERSION',
                    'name': 'version',
                    'data': null,
                    'render': Class._buildVersion
                }, {
                    'title': 'DT.PACKAGE_LATEST',
                    'name': 'latest',
                    'data': null,
                    'render': Class._buildLatest
                }, {
                    'title': 'DT.PACKAGE_REPO_TYPE',
                    'name': 'repo_type',
                    'data': 'repo_type',
                    'visible': false
                }, {
                    'title': 'DT.PACKAGE_REPO_URL',
                    'name': 'repo_url',
                    'data': 'repo_url',
                    'visible': false
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '200px',
                    'render': Class._buildControls
                }]
            });

            Class.packageDT.on('draw', function ( event, settings ) {
                One.helpers('core-bootstrap-tooltip');
            });

        },

        _buildVersion : function ( data, type, row, meta ) {
            return ( data.version === data.latest )
                ? data.latest
                : '<strong class="red">'+data.version+'</strong>';
        },

        _buildLatest : function ( data, type, row, meta ) {
            return ( data.version === data.latest )
                ? data.latest
                : '<strong class="green">'+data.latest+'</strong>';
        },

        _buildControls : function ( data, type, row, meta ) {

            let html = '';

            $( data.controls ).each(function (i, el) {

                if ( el.type === 'icon' ) {
                     let elm =$('<i>')
                        .attr('data-id', el.id)
                        .attr('data-value', el.value)
                        .attr('class', el.class)
                        .attr('title', el.title)
                        .attr('data-toggle', 'tooltip')
                        .attr('data-animation', 'true')
                        .attr('data-placement', 'bottom')
                        .attr('data-delay', '{ "show": 2000, "hide": 100 }');

                    /** We only want to show the activate and deactivate control for Tiger modules and themes. */
                     if ( el.class.search('active') > -1 && ( Class.packageTypes.indexOf( data.type ) === -1 || parseInt( data.required, 10 ) === 1) ) {
                         elm.addClass('invisible');
                     }

                    /** We only want to show the delete control for Tiger modules and themes that are non-essential. */
                    if ( el.class.search('delete') > -1 && parseInt( data.required, 10 ) === 1 ) {
                        elm.addClass('invisible');
                    }

                     html += elm.prop('outerHTML');
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

            $('#save-package-button').on( 'click', Class._savePackage );
            $('#delete-package-button').on( 'click', Class._delete );

            $('#sync-packages').on('click', Class._confirmSync );
            // $('#sync-package-confirm').on( 'click', Class._sync );
            $('#sync-package-confirm').on( 'click', Class._getSyncedPackageList );

            $('#add-package').on('click', Class._showAddPackage );

            $('body').on('click', 'table i.update', Class._update );
            $('body').on('click', 'table i.edit', Class._showEditPackage );
            $('body').on('click', 'table i.active', Class._active );
            $('body').on('click', 'table i.delete', Class._confirmDelete );

            One.helpers('core-bootstrap-tooltip');

            $().tigerDOM('initToggleControls');

        },

        /** Plugin Actions */

        _showAddPackage : function ( event ) {

            $('#add-package-header').removeClass('hide');
            $('#edit-package-header').addClass('hide');

            $('#package-tabs li:first-child a').tab('show');
            $('#package-form').tigerForm( 'reset' );
            $('#package-details').addClass('hide');
            $('#package-details span').html('');
            $('#modal-package-form').modal('show');

        },

        _showEditPackage : function ( event ) {

            let data = Class.packageDT.row( $(this).closest('tr') ).data();

            $('#add-package-header').addClass('hide');
            $('#edit-package-header').removeClass('hide');

            $('#package-tabs li:first-child a').tab('show');

            $('#package-form').tigerForm( 'reset' );

            $('#package-form #package_id').val( data.package_id );
            $('#package-form #name').val( data.name );
            $('#package-form #target_version').val( data.target_version );
            $('#package-form #repo_type').val( data.repo_type );
            $('#package-form #repo_url').val( data.repo_url );

            $('#package-details .package_description').html( data.description );
            $('#package-details .package_type').html( data.type );
            $('#package-details .package_version').html( data.version );
            $('#package-details .package_latest').html( data.latest );
            $('#package-details .package_active').html( data.active );

            $('#package-form .update_date').html( data.update_date );
            $('#package-form .update_user_id').html( data.update_user_id );
            $('#package-form .create_date').html( data.creaate_date );
            $('#package-form .create_user_id').html( data.create_user_id );

            if ( Class.packageTypes.indexOf( data.type ) === -1  ) {
                $('#package-details .package_active').closest('p').addClass('hide');
            }
            else {
                $('#package-details .package_active').closest('p').removeClass('hide');
            }

            $('#package-details').removeClass('hide');
            $('#modal-package-form').modal('show');

        },

        _active : function ( event ) {

            let $elm = $(this), data = {};

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( parseInt( data.result, 10 ) === 1 ) {

                    /** Update the icon's data-value and class. */

                    $elm.attr('data-value', data.data.active);
                    data.data.active = ( parseInt(data.data.active,10) === 1 )
                        ? $elm.removeClass('fa-play').addClass('fa-pause')
                        : $elm.addClass('fa-play').removeClass('fa-pause');

                }

                $( '#page-messages' ).css('overflow', 'hidden').tigerDOM('change', {
                    content: data.html[0],
                    removeClick: true,
                    removeTimeout: 0
                });

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

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'package:package';
            data.method = 'setActivePackage';
            data.package_id = $elm.attr('data-id');

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

            let $elm = $(this), data = {};

            function beforeSend () {
                $elm.removeClass('fa-angle-double-up');
                $elm.addClass('fa-sync-alt fa-spin');
            }

            function complete () {
                $elm.removeClass('fa-sync-alt fa-spin');
                $elm.addClass('fa-angle-double-up');
            }

            function success ( data, textStatus, jqXHR ) {

                Class.packageDT.ajax.reload(null,false);

                $( '#page-messages' ).css('overflow', 'hidden').tigerDOM('change', {
                    content: data.html[0],
                    removeClick: true,
                    removeTimeout: 0
                });

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

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'package:package';
            data.method = 'updatePackage';
            data.package_id = $elm.attr('data-id');

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

        _savePackage : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#save-package-button i.icon').addClass('hide');
                $('#save-package-button i.ajax').removeClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $('#save-package-button i.icon').removeClass('hide');
                $('#save-package-button i.ajax').addClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#modal-package-form').modal('hide');
                    $('div.block-options [data-tiger-reload-table]').trigger('click');
                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#package-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#package-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'package:package',
                method  : 'savePackage'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#package-form').tigerForm('getFormValues', apiParams );

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

        _confirmSync : function ( event ) {

            $('#sync-error-message').css('height', '').children().remove();
            $('#sync-progress').css('width', '0%');
            $('#modal-package-confirm-sync').modal('show');

        },

        _getSyncedPackageList : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#sync-progress').addClass('progress-bar-striped').addClass('progress-bar-animated').css('width','0%');
                $('#sync-progress span').html('width','0%');
                $('#rsync-package-confirm').prop('disabled', true);
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class._syncPackageList( data.data.installed );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#sync-error-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#sync-error-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'package:package',
                method  : 'getSyncPackageList',
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

        _syncPackageList : function ( packages ) {

            let increment = 100/packages.length;
            let completed = 0;
            let total = 0;
            let errors = 0;

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                completed++;
                total += increment;
                if ( total > 100 ) { total = 100; }

                $('#sync-progress').addClass('progress-bar-striped').addClass('progress-bar-animated').css('width', Math.round( total ) + '%');
                $('#sync-progress span').html( Math.round( total ) + '%');

                if ( completed === packages.length ) {
                    $('#sync-package-confirm').prop('disabled', false);
                    $('#sync-progress').removeClass('progress-bar-striped').removeClass('progress-bar-animated');
                    if ( errors === 0 ) {
                        setTimeout(function () {
                            $('#modal-package-confirm-sync').modal('hide');
                            $('div.block-options [data-tiger-reload-table]').trigger('click');
                        }, 2000);
                    }
                }

                if ( data.result !== 1 ) {

                    /** Oops, something went wrong ... */

                    errors++;

                    $( '#sync-error-message' ).css('overflow','hidden').tigerDOM( 'insert', {
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

                $( '#sync-error-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            $.each( packages, function ( i, package ) {

                Class._sync( package, success, error );

            });

        },

        _sync : function ( package, success, error ) {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            let data = {
                service : 'package:package',
                method  : 'syncPackage',
                package : package
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

            Class.confirm = Class.packageDT.row( $(this).closest('tr') ).data();
            $('#delete-name').html( Class.confirm.name );
            $('#modal-package-confirm-delete #form-delete-message').css('height', '').children().remove();
            $('#modal-package-confirm-delete').modal('show');

        },

        _delete : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
                $('#delete-package-button i.icon').addClass('hide');
                $('#delete-package-button i.ajax').removeClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $('#delete-package-button i.icon').removeClass('hide');
                $('#delete-package-button i.ajax').addClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.confirm = null;
                    $('#modal-package-confirm-delete').modal('hide');
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
                service     : 'package:package',
                method      : 'deletePackage',
                package_id  : Class.confirm.package_id
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
  
    $.fn.packageAdminPackage = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().packageAdminPackage();
    
})( jQuery );
