/**
 * jQuery Tiger ACL Admin Plugin
 */

(function( $ ){
    
    let Class = {

        userDT : null,
        
        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initControls();

            });

        },

        // Admin Functions //

        _initControls : function () {

            $('#save-contact-button').on( 'click', Class._save );

            $('body').on( 'click', 'table i.contact', Class._view );

            Class._initSContactIdSelect2();
            Class._initTypeContactSelect2();

        },

        // Select2 Controls //

        _initSContactIdSelect2 ( ) {

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 1,
                    limit       : 10,
                    order       : 'create_date ASC',
                    service     : 'account:admin',
                    method      : 'getContactSelect2List',
                    entity      : $('#contact-form #entity').val(),
                    entity_id   : $('#contact-form #entity_id').val()
                }

                return query;

            }

            $('#contact-form #contact_id').select2({
                minimumResultsForSearch : -1,
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                },
                escapeMarkup: function( markup ) {
                    return markup;
                },
                templateSelection: function(data) {
                    let html = '<span>';
                    html += ( parseInt(data.primary,10) === 1 ) ? '<i class="fa fa-star"></i> ' : '<i> </i>';
                    html += ( data.id ) ? data.type + ' - ' : '';
                    html += data.text
                    return html;
                },
                templateResult : function ( data ){
                    let html = '<span>';
                    html += ( parseInt(data.primary,10) === 1 ) ? '<i class="fa fa-star"></i> ' : '<i> </i>';
                    html += ( data.id ) ? data.type + ' - ' : '';
                    html += data.text
                    return html;
                }
            });

            $('#contact-form #contact_id').on('select2:select', Class._edit );

        },

        _initTypeContactSelect2 ( ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'contact',
                    key         : ''
                }

                return query;

            }

            $('#contact-form #type_contact').select2({
                minimumResultsForSearch : -1,
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            });

        },

        _setTypeContactSelect2 ( type_contact ) {

            if ( ! type_contact ) { return; }

            let $typeContact = $('#contact-form #type_contact');

            $.ajax({
                type        : 'GET',
                dataType    : "json",
                url         : '/api/service/account:admin/method/getTypeSelect2List/reference/contact/key/' + type_contact
            }).then( function ( data ) {

                let option = new Option( data.results[0].text, data.results[0].id, true, true);
                $typeContact.append(option).trigger('change');

                $typeContact.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

            });

        },

        // CRUD Functions //

        _resetContact(){

            $('#contact-form').tigerForm('reset');
            $('#contact-form #contact_id').select2('destroy');
            $('#contact-form #type_contact').select2('destroy');
            Class._initSContactIdSelect2();
            Class._initTypeContactSelect2();

        },

        _view : function ( event ) {

            Class._resetContact();

            /**
             * The contact form is used by both orgs and users, so we need to
             * tell the form, service and eventually the model which tyep of
             * entitu and entity_id we are using..
             */
            $('#contact-form #entity').val( $(this).closest('table').attr('data-entity') );
            $('#contact-form #entity_id').val( $(this).attr('data-id') );

            $('#modal-contact-form').modal('show');

        },

        _edit : function ( event ) {

            console.log(this, event, $('#contact-form #contact_id').val() );

            /** if the value is empty, then it's a new contact. Just clear the form and return. */
            if ( ! $('#contact-form #contact_id').val() ) {

                Class._resetContact();
                return;

            }

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $('#contact-form').tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeContactSelect2( data.data.type_contact );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#contact-form .form-message' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#contact-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

            }

            let data = {
                service     : 'account:admin',
                method      : 'getContact',
                contact_id  : $('#contact-form #contact_id').val()
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

        _save : function ( event ) {

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    $('#contact-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#contact-form .form-message')
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
                            form: 'Account_Form_Contact',
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

                $('#contact-form .form-message').css('overflow','hidden').tigerDOM( 'change', {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                });
                
            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service     : 'account:admin',
                method      : 'saveContact',
                contact_id  : $('#contact-form #contact_id').val(),
                entity      : $('#contact-form #entity').val(),
                entity_id   : $('#contact-form #entity_id').val()
            };

            /** Note that our API params will be added to the form data */
            let data = $('#contact-form').tigerForm('getFormValues', apiParams );

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
  
    $.fn.accountAdminUserContact = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().accountAdminUserContact();
    
})( jQuery );
