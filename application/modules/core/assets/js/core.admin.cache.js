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
 * jQuery Tiger Core Admin Cache Plugin
 */

(function( $ ){
    
    let Class = {

        configDT : null,
        staticConfigDT : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initControls();

            });

        },

        // Admin Functions //

        _initControls : function () {

            $('#clear-cache').on( 'click', Class._clear );
            $('#useCache').on( 'change', Class._update );

            $().tigerDOM('initToggleControls');

        },

        _clear : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Alert */

                $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'insert', {
                    content       : data.html[0],
                    removeClick   : true,
                    removeTimeout : 0
                });

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
                service : 'core:admin',
                method  : 'clearcache',
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
            data.active = $elm.is(':checked') ? 1 : 0;

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'core:admin';
            data.method = 'useCache';

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
  
    $.fn.coreAdminCache = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().coreAdminCache();
    
})( jQuery );
