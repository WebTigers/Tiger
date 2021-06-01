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
 * jQuery Tiger Profile Contact Plugin
 */

(function( $ ){

    let $userContactForm = $('#user-form-contact');
    let $orgContactForm = $('#org-form-contact');

    let Class = {

        currentContactId : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initControls();

            });

        },

        // Admin Functions //

        _initControls : function () {

            $('#save-user-contact-button, #save-org-contact-button').on( 'click', Class._save );
            $('#remove-user-contact-button, #remove-org-contact-button').on( 'click', Class._remove );

            Class._initSContactIdSelect2( $userContactForm, 'user' );
            Class._initSContactIdSelect2( $orgContactForm, 'org' );
            Class._initTypeContactSelect2( $userContactForm );
            Class._initTypeContactSelect2( $orgContactForm );

        },

        // Select2 Controls //

        _initSContactIdSelect2 : function ( $contactForm ) {

            let entity = $contactForm.attr('id').split('-')[0];
            let type_contact_id = entity + '_contact_id';
            $contactForm.find('#contact_id').attr('id', type_contact_id);

            function data( params ) {

                let query = {
                    search      : params.term,
                    page        : params.page || 0,
                    limit       : 10,
                    order       : 'create_date ASC',
                    service     : 'account:account',
                    method      : 'getContactSelect2List',
                    entity      : entity
                }

                return query;

            }

            $contactForm.find( '#' + type_contact_id ).select2({
                minimumResultsForSearch : -1,
                width : '100%',
                ajax : {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                },
                escapeMarkup : function( markup ) {
                    return markup;
                },
                templateSelection : function(data) {
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

            $contactForm.find( '#' + type_contact_id ).on('select2:select', Class._edit );

        },

        _initTypeContactSelect2 : function ( $contactForm ) {

            function data( params ) {

                let query = {
                    service     : 'account:admin',
                    method      : 'getTypeSelect2List',
                    reference   : 'contact',
                    key         : ''
                }

                return query;

            }

            $contactForm.find('#type_contact').select2({
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

        _setTypeContactSelect2 : function ( $contactForm, type_contact ) {

            if ( ! type_contact ) { return; }

            let $typeContact = $contactForm.find('#type_contact');

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

        _resetContact : function ( $contactForm, exclude ) {

            $contactForm.tigerForm('reset', exclude );
            $contactForm.find('#type_contact').select2('destroy');

            Class._initTypeContactSelect2( $contactForm );

        },

        _edit : function ( event ) {

            let $form = $( this ).closest('form');

            Class._resetContact( $form, []);
            $('#remove-user-contact-button').prop('disabled', false);
            $form.find('div.overlay').animate({'opacity': '0'}, 400, function (){
                $(this).css('display','none');
            });

            /** if the value is empty, then it's a new contact. Just clear the form and return. */
            if ( event.params.data.id === '' ) {
                $('#remove-user-contact-button').prop('disabled', true);
                return;
            }

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    $form.tigerForm('setFormValues', data.data );

                    /**
                     * Select2 controls present an interesting issue since they are dynamically
                     * populated. We need to make an ajax call out to the server to populate
                     * the option properly.
                     */
                    Class._setTypeContactSelect2( $form, data.data.type_contact );

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

                $( '#contact-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

            }

            Class.currentContactId = event.params.data.id;

            let data = {
                service     : 'account:account',
                method      : 'getContact',
                contact_id  : event.params.data.id,
                entity      : $form.find('#entity').val()
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

            let $form = $( this ).closest('form');

            function beforeSend () {
                $(this).find('i.ajax').removeClass('hide');
                $(this).find('i.icon').addClass('hide');
            }

            function complete () {
                $(this).find('i.ajax').addClass('hide');
                $(this).find('i.icon').removeClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    $('#page-messages').css('overflow', 'hidden').tigerDOM('change', {
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

                $('#page-messages').css('overflow','hidden').tigerDOM( 'change', {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                });

            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service     : 'account:account',
                method      : 'saveContact',
                contact_id  : Class.currentContactId,
                entity      : $form.find('#entity').val()
            };

            /** Note that our API params will be added to the form data */
            let data = $form.tigerForm('getFormValues', apiParams );

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

        _remove : function ( event ) {

            let $form = $( this ).closest('form');

            function beforeSend ( jqXHR, settings ) {
                $(this).find('i.ajax').removeClass('hide');
                $(this).find('i.icon').addClass('hide');
            }

            function complete ( jqXHR, textStatus ) {
                $(this).find('i.ajax').addClass('hide');
                $(this).find('i.icon').removeClass('hide');
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class._resetContact( $form, [] );
                    $form.find('#contact_id').select2('destroy');
                    Class._initSContactIdSelect2( $form );

                }

                /** Oops, something went wrong ... */

                $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
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

                $( '#contact-form .form-message' ).css('overflow','hidden').tigerDOM( 'insert', oMessage );

            }

            let data = {
                service     : 'account:account',
                method      : 'removeContact',
                contact_id  : Class.currentContactId,
                entity      : $form.find('#entity').val()
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

    $.fn.accountContact = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };

    $().accountContact();

})( jQuery );
