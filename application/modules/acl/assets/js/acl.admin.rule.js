/**
 * jQuery Tiger ACL Admin Plugin
 */

(function( $ ){
    
    let Class = {

        ruleDT : null,
        staticRuleDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initRuleDataTable();
                Class._initControls();
                Class._initStaticRuleDataTable();

            });

        },

        // Admin Functions //

        _initRuleDataTable : function () {

            Class.ruleDT = $('#rulesDT').DataTable({
                'searching': true,
                'processing': false,
                'serverSide': true,
                'orderMulti': true,
                'order': [[1, 'asc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'initComplete': function (settings, json) {

                },
                'ajax': {
                    'url': '/api',
                    'type': 'POST',
                    'dataType': 'json',
                    'dataSrc': 'data',
                    'data': {
                        service: 'acl:admin',
                        method: 'getAdminRulesDataTable'
                    }
                },
                'columns': [{
                    'title': 'Rule Id',
                    'name': 'rule_id',
                    'data': 'rule_id',
                    'visible': false
                }, {
                    'title': 'Priority',
                    'name': 'priority',
                    'data': 'priority'
                }, {
                    'title': 'Rule Name',
                    'name': 'rule_name',
                    'data': 'rule_name'
                }, {
                    'title': 'Rule Description',
                    'name': 'rule_description',
                    'data': 'rule_description'
                }, {
                    'title': 'Permission',
                    'name': 'permission',
                    'data': 'permission'
                }, {
                    'title': 'Resource',
                    'name': 'resource',
                    'data': 'resource'
                }, {
                    'title': 'Privilege',
                    'name': 'privilege',
                    'data': 'privilege'
                }, {
                    'title': 'Assertion',
                    'name': 'assertion',
                    'data': 'assertion'
                }, {
                    'title': 'Role',
                    'name': 'role',
                    'data': 'role'
                }, {
                    'title': 'Active',
                    'name': 'active',
                    'data': 'active',
                    'class': 'active',
                    'visible': false
                }, {
                    'title': 'Deleted',
                    'name': 'deleted',
                    'data': 'deleted',
                    'class': 'deleted',
                    'visible': false
                }, {
                    'title': 'Controls',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '150px',
                    'render': Class._buildControls,
                }]
            });

            Class.ruleDT.on('preXhr.dt', function (event, settings, data) {
                // data.page = Class.ruleDT.page() + 1;
                // data.search = Class.ruleDT.search();
                // data.locale = 'en';
            });

            Class.ruleDT.on('xhr.dt', function (event, settings, json, xhr) {
                // json.recordsTotal = parseInt( json.recordsTotal, 10);
                // json.recordsFiltered = parseInt( json.recordsFiltered, 10);
            });

        },

        _buildControls : function ( data, type, row, meta ) {

            let html = '';

            $( data.controls ).each(function (i, el) {

                if ( el.type === 'icon' ) {
                    html += $('<i>')
                        .attr('data-id', el.id)
                        .attr('class', el.class)
                        .attr('title', el.title)
                        .attr('data-toggle', 'tooltip')
                        .prop('outerHTML');
                }

                if ( el.type === 'button' ) {
                    html += $('<button>').attr('data-id', el.id).attr('class', el.class).attr('title', el.title).prop('outerHTML');
                }

            });

            return html;

        },

        _initControls : function () {

            $('#add-rule').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

        },

        _add : function ( event ) {

            $('#add-rule-header').removeClass('hide')
            $('#edit-rule-header').addClass('hide')
            $('#rule-form .boiler-plate').addClass('hide')
            $('#rule-form').tigerForm('reset');
            $('#modal-rules-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-rule-header').addClass('hide')
            $('#edit-rule-header').removeClass('hide')
            $('#rule-form .boiler-plate').removeClass('hide')
            $('#rule-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#rule-form').tigerForm('setFormValues', data.data );
                    $('#modal-rules-form').modal('show');

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
                method  : 'getRule',
                rule_id : $(this).attr('data-id')
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

            let $elm = $(this);
            let $row = $elm.closest('tr');

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( parseInt( data.result, 10 ) === 1 ) {

                    /** Update the icon and the row's value. */

                    if ( $elm.hasClass('active') ) {
                        Class.ruleDT.row( $row ).cell('.active').data(data.data.active);
                        data.data.active = ( parseInt(data.data.active,10) === 1 )
                            ? $elm.removeClass('fa-play').addClass('fa-pause')
                            : $elm.addClass('fa-play').removeClass('fa-pause');
                    }
                    else if ( $elm.hasClass('deleted') ) {
                        Class.ruleDT.row( $row ).cell('.deleted').data(data.data.deleted);
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

            /** Based on the control that made the request, let's grab our data! */
            let data = Class.ruleDT.row( $row ).data();
            delete data.DT_RowId;
            delete data.controls;

            /** Flip the bool before sending to the server. */
            if ( $elm.hasClass('active') ) {
                data.active = ( parseInt(data.active,10) === 1 ) ? 0 : 1;
            }
            else if ( $elm.hasClass('deleted') ) {
                data.deleted = ( parseInt(data.deleted,10) === 1 ) ? 0 : 1;
            }
            else {
                return;
            }

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'acl:admin';
            data.method = 'updateRule';

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

                    $('#rule-form .form-message').css('overflow', 'hidden').tigerDOM('insert', {
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
                            form: 'Acl_Form_Rule',
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
                method  : 'saveRule'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#rule-form').tigerForm('getFormValues', apiParams );

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

        _initStaticRuleDataTable : function () {

            Class.staticRuleDT = $('#staticRulesDT').DataTable({
                'searching': true,
                'processing': false,
                'serverSide': false,
                'orderMulti': true,
                'order': [[0, 'asc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'initComplete': function (settings, json) {

                },
                'ajax': {
                    'url': '/api',
                    'type': 'POST',
                    'dataType': 'json',
                    'dataSrc': 'data',
                    'data': {
                        service: 'acl:admin',
                        method: 'getAdminStaticRulesDataTable'
                    }
                },
                'columns': [{
                    'title': 'Rule Id',
                    'name': 'rule_id',
                    'data': 'rule_id',
                    'visible': false
                }, {
                    'title': 'Priority',
                    'name': 'priority',
                    'data': 'priority'
                }, {
                    'title': 'Rule Name',
                    'name': 'rule_name',
                    'data': 'rule_name'
                }, {
                    'title': 'Rule Description',
                    'name': 'rule_description',
                    'data': 'rule_description'
                }, {
                    'title': 'Permission',
                    'name': 'permission',
                    'data': 'permission'
                }, {
                    'title': 'Resource',
                    'name': 'resource',
                    'data': 'resource'
                }, {
                    'title': 'Privilege',
                    'name': 'privilege',
                    'data': 'privilege'
                }, {
                    'title': 'Assertion',
                    'name': 'assertion',
                    'data': 'assertion'
                }, {
                    'title': 'Role',
                    'name': 'role',
                    'data': 'role'
                }]
            });

        },

    };
  
    $.fn.aclAdminRule = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().aclAdminRule();
    
})( jQuery );
