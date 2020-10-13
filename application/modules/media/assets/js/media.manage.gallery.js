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
 * jQuery Tiger Media Manage Dashboard Plugin
 */
(function( $ ){
    
    let Class = {

        clipboard   : null,

        /** The _fetchMedia() method will pull from these global params. */
        search      : '',
        limit       : '25',
        offset      : '0',
        orderby     : 'update_date',
        direction   : 'DESC',

        init : function( ) {

            $(document).ready(function() {

                Dropzone.autoDiscover = false;

                // Page init stuff goes here. //
                Class._initControls();
                Class._fetchMedia();

            });

        },

        // Admin Functions //

        _initControls : function () {

            // Init the prettyPhoto library
            // http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
            $("a[rel^='prettyPhoto']").prettyPhoto({
                social_tools : false,
                theme        : 'light_square'
            });

            // Init the Dropzone library
            // https://www.dropzonejs.com/#configuration-options
            $('#upload-zone').addClass('dropzone').dropzone({
                init: function() {
                    this.on( 'success', function( file, data ) {
                        if ( data.result === 1 ) {
                            Class._addToGallery(data.data);
                        }
                    });
                },
                url: '/api',
                addRemoveLinks : true,
                params: function( files ) {

                    return {
                        module      : 'media',
                        service     : 'media:media',
                        method      : 'upload',
                        storageType : '',       // 'File' or 'S3',
                        rename      : '',       // '' or 'othername' or 'uuid' (Does not change the file extension.)
                        prefixPath  : 'type',   // '' or 'type' or '/path/to/file' (For File oath or S3 prefix)
                        bucket      : ''        // 'bucket-name' (For S3 Uploads only. Will use the default bucket if not set.)
                    };

                }
            });

            $('#gallery').on( 'click', '.img-edit', Class._edit );
            $('#save-media-button').on( 'click', Class._update );

            $().tigerDOM('initToggleControls');

            // https://clipboardjs.com/
            Class.clipboard = new ClipboardJS('button.img-copy');
            Class.clipboard.on('success', function( event ) {
                $(event.trigger).attr('title', $(event.trigger).attr('data-title')).tooltip('show');
                setTimeout(function (){
                    $(event.trigger).tooltip('hide');
                }, 1000);
                setTimeout(function (){
                    $(event.trigger).removeAttr('title').tooltip('dispose');
                }, 2000);
            });

        },

        _fetchMedia : function () {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class._addToGallery( data.data );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service     : 'media:media',
                method      : 'getGallery',
                search      : Class.search,
                limit       : Class.limit,
                offset      : Class.offset,
                orderby     : Class.orderby,
                direction   : Class.direction
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

        _addToGallery : function ( data ) {

            $( data ).each( function( i, data ) {
                Class._buildMedia( data );
            });

            $('.img-lightbox').on('click.lightbox', function ( event ) {

                let $img = $(this).closest('div.options-container').find('img');

                $.prettyPhoto.open(
                    $img.attr('src'),
                    $img.attr('title'),
                    $img.attr('alt')
                );

            });

        },

        _buildMedia : function ( data ) {

            /** Get the template as a jQuery object ... */
            let $galleryTemplate = $('#gallery-template').first().clone();

            $galleryTemplate.find('img')
                .attr('id', data.media_id)
                .attr('src', data.public_url)
                .attr('data-extension', data.extension)
                .attr('title', data.caption_title)
                .attr('alt', data.description);

            let url = $('#metadata').data('base-url') + data.public_url;
            $galleryTemplate.find('button.img-copy').attr('data-clipboard-text', url);

            if ( data.caption_title ) {
                $galleryTemplate.find('h3.caption-title').html(data.caption_title);
            }

            if ( data.description ) {
                $galleryTemplate.find('h4.description').html( data.description );
            }

            $( '#gallery' ).append( $galleryTemplate.html() );

        },

        _viewImage : function ( ) {



        },

        _viewPdf : function ( ) {

            let uri = 'path/to/filename.pdf?iframe=true&height=80%&width=60%';

            $.fn.prettyPhoto({social_tools:null});
            $.prettyPhoto.open( uri, 'Title', 'Alt Description' );

        },

        _add : function ( event ) {

            $('#add-media-header').removeClass('hide')
            $('#edit-media-header').addClass('hide')
            $('#media-form .boiler-plate').addClass('hide')
            $('#media-form').tigerForm('reset');
            $('#modal-medias-form').modal('show');

        },

        _edit : function ( event ) {

            $('#media-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    let staticDataVars = [
                        'public_url',    'type_storage',
                        'bucket',        'prefix_path',
                        'mime_type',     'filename',
                        'size',          'height',
                        'width',         'upload_ip'
                    ];

                    $('#media-form').tigerForm('setFormValues', data.data, staticDataVars );
                    $('#modal-media-form').modal('show');

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
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
                service     : 'media:media',
                method      : 'getMedia',
                media_id    : $(this).closest('div.options-container').find('img').attr('id')
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
             * pieces of data, typically from datatables.
             */

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( data.html ) {

                    $('#media-form .form-message')
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
                        form: 'Media_Form_Media',
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

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                $( '#media-form .form-message' )
                    .css('overflow', 'hidden')
                    .tigerDOM('change', {
                        content: '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                        removeClick: true,
                        removeTimeout: 0
                    });

            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'media:media',
                method  : 'updateMedia',
                active  : ( $('#media-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#media-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#media-form').tigerForm('getFormValues', apiParams );

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

                    $('#media-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#page-signup-form .form-message')
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
                            form: 'Media_Form_Media',
                            element: null,
                            messages: []
                        };

                        $.each(data.messages, function (el, msgObj) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each(msgObj, function (errName, errMsg) {
                                console.log(errName, errMsg);
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
                service : 'media:admin',
                method  : 'saveMedia',
                active  : ( $('#media-form #active').is(':checked') ) ? 1 : 0,
                deleted : ( $('#media-form #deleted').is(':checked') ) ? 1 : 0
            };

            /** Note that our API params will be added to the form data */
            let data = $('#media-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.mediaManageGallery = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().mediaManageGallery();
    
})( jQuery );
