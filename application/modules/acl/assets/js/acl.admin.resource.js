/**
 * jQuery Tiger ACL Admin Plugin
 */

(function( $ ){
    
    let Class = {

        resourceDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initResourceDataTable();


                // Class._initResendForm();

            });

        },

        // Admin Functions //

        _initResourceDataTable : function () {

            Class.resourceDT = $('#resourcesDT').DataTable({
                'searching': true,
                'processing': false,
                'serverSide': true,
                'orderMulti': true,
                'order': [[0, 'asc']],
                'class': 'hover',
                'autoWidth': true,
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
                        method: 'getAdminResourcesDataTable'
                    }
                },
                'columns': [{
                    'title': 'Resource Name',
                    'name': 'resource_name',
                    'data': 'resource_name'
                }, {
                    'title': 'Resource Description',
                    'name': 'resource_description',
                    'data': 'resource_description'
                }, {
                    'title': 'Resource',
                    'name': 'resource',
                    'data': 'resource'
                }, {
                    'title': 'Privilege',
                    'name': 'privilege',
                    'data': 'privilege'
                }, {
                    'title': 'Controls',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '190px',
                    'render': Class._buildControls,
                }]
            });

            Class.resourceDT.on('preXhr.dt', function (event, settings, data) {
                // data.page = Class.resourceDT.page() + 1;
                // data.search = Class.resourceDT.search();
                // data.locale = 'en';
            });

            Class.resourceDT.on('xhr.dt', function (event, settings, json, xhr) {
                // json.recordsTotal = parseInt( json.recordsTotal, 10);
                // json.recordsFiltered = parseInt( json.recordsFiltered, 10);
            });

        },

        _buildControls : function ( data, type, row, meta ) {

            console.log( data, type, row, meta );

            let html = '';

            $( data.controls ).each(function (i, el) {

                // <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="" class="js-tooltip-enabled" data-original-title="Edit">
                //                                     <i class="fa fa-fw fa-pencil-alt"></i>
                //                                 </a>

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

        _initResendForm : function () {

            $('#resend-button').on( 'click', Class._submitForm );

        },
        
        _submitForm : function ( event ) {

            function beforeSend () {

                /* Disable any elements if you like. */
                // $('#form_id').find('input, select').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#resend-button .ajax').toggleClass( 'hide' );
                $('#resend-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                // $('#form_id').find('input, select').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#resend-button .ajax').toggleClass( 'hide' );
                $('#resend-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {
                
                // Resend Success / Error //

                $( '#page-resend-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', {
                    content       : data.html[0],
                    removeClick   : true,
                    removeTimeout : 0
                });

            }

            function error ( jqXHR, textStatus, errorThrown ) { 

                // grecaptcha.reset( reCaptchaSignup );
                
                // show general error message
                let oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );
                
            };

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'user:account',
                method  : 'resend'
            };

            /** Note that our API params will be added to the form data */
            let data = $('#page-resend-form').tigerForm('getFormValues', apiParams );

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
