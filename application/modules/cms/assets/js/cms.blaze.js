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
 * jQuery Tiger BLAZE Admin Plugin
 */

(function( $ ){

    let Class = {

        init : function( ) {

            $(document).ready(function() {

                Class._initControls();

            });

        },

        // Admin Functions //

        _initControls : function () {

            console.log( document.styleSheets );

            console.log('FF', parseInt( 'FF', 16 )  );

            $('h1').on('mouseover', function (event ) {

                let regex = /rgba?\(\s*(25[0-5]|2[0-4]\d|1\d{1,2}|\d\d?)\s*,\s*(25[0-5]|2[0-4]\d|1\d{1,2}|\d\d?)\s*,\s*(25[0-5]|2[0-4]\d|1\d{1,2}|\d\d?)\s*,?\s*([01\.]\.?\d?)?\s*\)/;

                let bgColor = "rgba(0, 255, 0, .5)";

                console.log( bgColor.match( regex ) );

                // $(this).prop('background-color', '');
            });

            $('h1').on('mouseout', function (event ) {
                // $(this).css('border','none');
            });

        },

        // CRUD Functions //

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

                    /** Set the page_id for saved record so the next save is an update to the DB. */
                    if ( data.data.page_id ) {
                        $('#page_id').val( data.data.page_id );
                    }

                    $('#page-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#page-form .form-message')
                            .css('overflow', 'hidden')
                            .tigerDOM('change', {
                                content: data.html[0],
                                removeClick: true,
                                removeTimeout: 0
                            });

                    }

                    if ( data.messages ) {

                        let msgData = {
                            result: 0,
                            form: 'Cms_Form_Page',
                            element: null,
                            messages: []
                        };

                        $.each(data.messages, function (el, msgObj) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each(msgObj, function (errName, errMsg) {
                                msgData.messages.push({message: errMsg, error: errName, class: "alert"});
                            });

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
                service : 'cms:admin',
                method  : 'savePage',
            };

            /** Note that our API params will be added to the form data */
            let data = $('#btabs-animated-fade-page-content, #btabs-animated-fade-page-scripts, #btabs-animated-fade-settings')
                    .tigerForm('getFormValues', apiParams );

            delete data['ck-content'];
            Class._setContent();

            data.content = Class.content;
            data.options = $('#btabs-animated-fade-page-options').tigerForm('getFormValues');
            data.meta = Class._getMetaFormData();
            data.links = Class._getLinksFormData();
            data.headScripts = Class._getHeadScriptsFormData();
            data.inlineScripts = Class._getInlineScriptsFormData();
            data.styles = $('#styles').val();
            data.scripts = $('#scripts').val();
            data.version = ( $('#save-version').is(':checked') ) ? 1 : 0;

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

    };
  
    $.fn.cmsBlaze = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().cmsBlaze();
    
})( jQuery );

