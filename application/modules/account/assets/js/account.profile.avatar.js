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
 * jQuery Tiger Account Profile Avatar Plugin
 */
(function( $ ){
    
    let Class = {

        /** Dropzone plugin globals. */
        dropzone            : null,
        imageExtensions     : null,
        allowedExtensions   : null,
        imageMaxWidth       : null,
        imageMaxHeight      : null,
        fileMaxFiles        : null,
        fileMaxFilesize     : null,
        dictionary          : null,

        /** The _fetchMedia() method will pull from these global params. */
        search      : '',
        limit       : '25',
        offset      : '0',
        orderby     : 'update_date',
        direction   : 'DESC',

        galleryInsert : false,

        media_id    : null,
        media_url   : null,

        init : function( ) {

            $(document).ready(function() {

                Dropzone.autoDiscover = false;

                // Page init stuff goes here. //
                Class._initGlobals();
                Class._initControls();

            });

        },

        // Profile Manage Functions //

        _initGlobals : function ( ) {

            function success ( data ) {

                Class.imageExtensions   = data.data.imageExtensions;
                Class.allowedExtensions = data.data.allowedExtensions;
                Class.imageMaxHeight    = data.data.imageMaxHeight;
                Class.imageMaxWidth     = data.data.imageMaxWidth;
                Class.fileMaxFiles      = data.data.fileMaxFiles;
                Class.fileMaxFilesize   = data.data.fileMaxFilesize;
                Class.dictionary        = data.data.dictionary;

                Class._initUploader();
                Class._fetchAvatars();

            }

            function error ( ) { }

            let data = {
                service : 'media:media',
                method  : 'getUploaderConfigs',
            };

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                success     : success,
                error       : error
            });

        },

        _initControls : function ( ) {

            $('#gallery').on( 'click', '.img-edit', Class._edit );
            $('#save-media-button').on( 'click', Class._update );
            $('#refresh-gallery').on( 'click', Class._refreshGallery );

            $('body').on( 'click', 'button.avatar-remove', Class._removeAvatar );

        },

        _initUploader : function ( ) {

            let allowed = '.'+Class.allowedExtensions.join(',.');

            // Init the Dropzone library
            // https://www.dropzonejs.com/#configuration-options
            // https://gitlab.com/meno/dropzone/-/wikis/FAQ
            Class.dropzone = $('#upload-zone').addClass('dropzone').dropzone({

                // Set some listeners on init. //
                init : function() {
                    let DZ = this;
                    DZ.on("thumbnail", function( file ) {
                        if ( file.type.indexOf('image') === 0 && ( file.width > Class.imageMaxWidth || file.height > Class.imageMaxHeight ) ) {
                            file.rejectDimensions();
                        }
                        else {
                            if ( file.size < Class.fileMaxFilesize )
                            {
                                file.acceptDimensions();
                            }
                        }
                    });
                    DZ.on( 'success', function( file, data ) {
                        if ( data.result === 1 ) {
                            Class.galleryInsert = true;
                            Class._addToGallery(data.data);
                            DZ.removeFile( file );
                        }
                        else {
                            // Show invalid message from data.messages

                        }
                    });
                    DZ.on( 'error', function( file, errorMessage, xhr ) {

                        console.error( file, errorMessage, xhr );

                    });
                },

                accept : function( file, done ) {
                    file.acceptDimensions = done;
                    file.rejectDimensions = function() {
                        done( Class.dictionary.dictInvalidImageDimensions );
                    };
                },

                url : '/api',
                addRemoveLinks : true,

                // If you want to add extra post params, put them in the return object here. //
                params : function( files ) {

                    return {
                        module      : 'media',
                        service     : 'media:media',
                        method      : 'upload',
                        type_media  : 'AVATAR',
                        storageType : '',       // 'File' or 'S3' or config media.default_storage_model,
                        rename      : '',       // '' or 'othername' or 'uuid' (Does not change the file extension.)
                        prefixPath  : 'avatar', // '' or 'type' or '/path/to/file' (For File path or S3 prefix)
                        bucket      : '',       // 'bucket-name' (For S3 Uploads only. Will use the default bucket if not set.)
                        tags        : 'avatar'  // this will get saved in the tags column of the db for searching
                    };

                },

                // Server-configured Upload Params. //
                maxFiles : Class.fileMaxFiles,
                acceptedFiles : allowed,

                // Dictionary //
                dictDefaultMessage              : Class.dictionary.dictDefaultMessage,
                dictFallbackMessage             : Class.dictionary.dictFallbackMessage,
                dictFallbackText                : Class.dictionary.dictFallbackText,
                dictFileTooBig                  : Class.dictionary.dictFileTooBig,
                dictInvalidFileType             : Class.dictionary.dictInvalidFileType,
                dictResponseError               : Class.dictionary.dictResponseError,
                dictCancelUpload                : Class.dictionary.dictCancelUpload,
                dictUploadCanceled              : Class.dictionary.dictUploadCanceled,
                dictCancelUploadConfirmation    : Class.dictionary.dictCancelUploadConfirmation,
                dictRemoveFile                  : Class.dictionary.dictRemoveFile,
                dictRemoveFileConfirmation      : Class.dictionary.dictRemoveFileConfirmation,
                dictMaxFilesExceeded            : Class.dictionary.dictMaxFilesExceeded,
                dictFileSizeUnits               : Class.dictionary.dictFileSizeUnits

            });

        },

        _fetchAvatars : function ( ) {

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

            Class.search = 'avatar';

            let data = {
                service     : 'media:media',
                method      : 'getUserGallery',
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

        _refreshGallery : function ( ) {

            $('#gallery').children().not('.default').hide(400, function(){
                $(this).remove();
            });
            setTimeout( function (){
                $().mediaManageGallery( '_fetchMedia' );
            }, 1000);

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

            let thumbnail = ( Class.imageExtensions.indexOf( data.extension ) > -1 )
                // Sux that .psd image files don't have a thumbnail view ...
                ? ( data.extension === 'psd' )
                    ? '/assets/media/img/' + data.extension + '.png'
                    : data.public_url
                : '/assets/media/img/' + data.extension + '.png';

            $galleryTemplate.find('img')
                .attr('id', data.media_id)
                .attr('src', thumbnail)
                .attr('data-extension', data.extension)
                .attr('title', data.caption_title)
                .attr('alt', data.description);

            // Only prepend the site's server host name for local files.
            let public_url = ( data.public_url[0] === '/' ) ? $('#metadata').data('base-url') : '';
            public_url += data.public_url;
            $galleryTemplate.find('button.img-copy').attr('data-clipboard-text', public_url);

            if ( data.caption_title ) {
                $galleryTemplate.find('h3.caption-title').html(data.caption_title);
            }

            if ( data.description ) {
                $galleryTemplate.find('h4.description').html( data.description );
            }

            if ( Class.galleryInsert === false ) {
                $('#gallery').append($galleryTemplate.html());
            }
            else {
                $('#gallery').prepend($galleryTemplate.html());
                Class.galleryInsert = false;
            }
        },

        _viewImage : function ( ) {



        },

        _removeAvatar : function ( event ) {

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    let $el = $( 'img[id="' + Class.media_id + '"]').closest('div.avatar-container');
                    let height = $el.prop('scrollHeight');
                    $el.animate({'opacity':0}, 400, function(){
                        $el.css('overflow', 'hidden').css('height', height)
                        $el.animate({'height' : 0 }, 400, function(){
                            $el.remove();
                        });
                    });

                    if ( $('img.img-avatar').attr('src') === Class.media_url ) {
                        Class._selectDefault();
                    }

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#avatar-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#form-message-profile' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            Class.media_id = $(this).prev().find('img').attr('id');
            Class.media_url = $(this).prev().find('img').attr('src');

            let data = {
                service : 'media:media',
                method  : 'removeProfileAvatar',
                media_id : Class.media_id
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

        _selectDefault : function () {

            let src = $('#gallery .default img').attr('src');

            $( 'img.img-avatar' ).attr('src', src );
            $( '#page-header-user-dropdown img.rounded' ).attr('src', src );
            $( '#user-form-profile #avatar_url' ).val( src );

            $( '#avatar-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
                content       : $('#change-message').children()[0],
                removeClick   : true,
                removeTimeout : 0
            });

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

                        msgData.element = el;
                        msgData.messages = [];

                        $.each(msgObj, function (errName, errMsg) {
                            msgData.messages.push({message: errMsg, error: errName, class: "alert"});
                        });

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

        }

    };
  
    $.fn.accountProfileAvatar = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountProfileAvatar();
    
})( jQuery );
