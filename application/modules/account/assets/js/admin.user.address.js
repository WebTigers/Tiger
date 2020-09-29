/**
 * jQuery Tiger ACL Admin Plugin
 */

(function( $ ){
    
    let Class = {

        userDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                // Class._initControls();

            });

        },

        // Admin User Address Functions //

        _initControls : function () {

            $('#add-user').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

            $().tigerDOM('initToggleControls');

            Class._initRoleSelect2();
            Class._initTypeTitleSelect2();
            Class._initTypeSuffixSelect2();
            Class._initTypeHearaboutSelect2();
            Class._initReferralOrgSelect2();
            Class._initReferralUserSelect2();

        },

        // Select2 Controls //

        _initRoleSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 1,
                    limit   : 10,
                    order   : 'priority ASC',
                    service : 'account:admin',
                    method  : 'getRoleSelect2List'
                }

                return query;

            }

            $('#user-form #role').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setRoleSelect2 ( role ) {

            if ( role.length === 0 ) { return; }

            let $role = $('#user-form #role');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getRoleSelect2List/search/' + role
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $role.append(option).trigger('change');

                $role.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        _initTypeTitleSelect2 ( ) {

            function data( params ) {

                let query = {
                    service : 'account:admin',
                    method  : 'getTypeSelect2List',
                    type    : 'title'
                }

                return query;

            }

            $('#user-form #type_title').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeTitleSelect2 ( type_title ) {

            if ( ! type_title ) { return; }

            let $typeTitle = $('#user-form #type_title');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/type/' + type_title
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeTitle.append(option).trigger('change');

                $typeTitle.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        // CRUD Functions //

        _add : function ( event ) {

            $('#add-user-header').removeClass('hide')
            $('#edit-user-header').addClass('hide')
            $('#user-form .form-ids').addClass('hide');
            $('#user-form .boiler-plate').addClass('hide')
            $('#user-form').tigerForm('reset');
            $('#modal-users-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-user-header').addClass('hide');
            $('#edit-user-header').removeClass('hide');
            $('#user-form .boiler-plate').removeClass('hide');
            $('#user-form .form-ids').removeClass('hide');
            $('#user-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#user-form').tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setRoleSelect2( data.data.role );
                    Class._setTypeTitleSelect2( data.data.type_title );
                    Class._setTypeSuffixSelect2( data.data.type_suffix );
                    Class._setTypeHearaboutSelect2( data.data.type_hearabout );

                    // $('#user-form .form-ids .user_id').html( data.data.user_id );
                    $('#modal-users-form').modal('show');

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
                method  : 'getuser',
                user_id : $(this).attr('data-id')
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
            data.method = 'updateUser';
            data.user_id = $elm.attr('data-id');

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

                    $('#user-form .form-message').css('overflow', 'hidden').tigerDOM('insert', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#user-form .form-message')
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
                            form: 'Account_Form_User',
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
                method  : 'saveUser',
                user_id : $('#user-form #user_id').val()
            };

            /** Note that our API params will be added to the form data */
            let data = $('#user-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.accountAdminUserAddress = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountAdminUserAddress();
    
})( jQuery );
