/**
 * jQuery Plugin Template
 */

(function( $ ){

    let Class = {
        
        init : function( ) {

            $( document ).ready( function() {

            });            

        },

        // Parser Methods //

        options : function( params ) {

            /**
            {
                element: input,
                type: text,
                name: lorem,
                id: lorem,
                label: "First Name",
                description: "Enter your first name.",
                value: optional
            }
            */

            // console.log( params );

            /** returns a jQuery HTML snippet */
            let $template = Class[params.type]();

            $template.find('label').attr('for', params.id).html( params.label );
            $template.find('i').attr('title', params.description );
            $template.find( params.element ).attr( 'type', params.type ).attr( 'id', params.id ).attr( 'name', params.name );
            $.each( params.attribs, function( i, attrib ){
                if ( i.indexOf(['options','disableHidden']) ){ return false; }
                $template.find( params.element ).attr( i, attrib )
            });

            if ( params.value ) {
                switch ( params.type ) {

                    case 'text':
                    default:
                        $template.find( params.element ).val( params.value );
                        break;
                }
            }

            return $template;

        },

        meta : function( params ) {

            return Class.options( params );

        },

        links : function( params ) {

            /**
             {
                name: lorem,
                id: lorem,
                labelAttr: "First Name",
                descriptionAttr: "",
                labelValue: "",
                descriptionValue: "Enter your first name.",
                value: ""
            }
             */

            // console.log( params );

            /** returns a jQuery HTML snippet */
            let $template = Class.attribute( 'link' );

            $template.find( 'label.attribute' ).attr( 'for', params.id ).html( params.labelAttr );
            $template.find( 'i.attribute' ).attr( 'title', params.descriptionAttr );
            $template.find( 'select' ).attr( 'id', 'select-' + params.id ).attr( 'name', params.name ).val( params.name );

            $template.find( 'label.value' ).attr( 'for', params.id ).html( params.labelValue );
            $template.find( 'i.value' ).attr( 'title', params.descriptionValue );
            $template.find( 'input' ).attr( 'type', 'text' ).attr( 'id', params.id ).attr( 'name', params.name ).val( params.value );

            return $template;

        },

        scripts : function( params ) {

            /**
             {
                name: lorem,
                id: lorem,
                labelAttr: "First Name",
                descriptionAttr: "",
                labelValue: "",
                descriptionValue: "Enter your first name.",
                value: ""
            }
             */

            // console.log( params );

            /** returns a jQuery HTML snippet */
            let $template = Class.attribute( 'script' );

            $template.find( 'label.attribute' ).attr( 'for', params.id ).html( params.labelAttr );
            $template.find( 'i.attribute' ).attr( 'title', params.descriptionAttr );
            $template.find( 'select' ).attr( 'id', 'select-' + params.id ).attr( 'name', params.name ).val( params.name );

            $template.find( 'label.value' ).attr( 'for', params.id ).html( params.labelValue );
            $template.find( 'i.value' ).attr( 'title', params.descriptionValue );
            $template.find( 'input' ).attr( 'type', 'text' ).attr( 'id', params.id ).attr( 'name', params.name ).val( params.value );

            return $template;

        },

        // Elements //

        text : function ( ) {

            return $(
                '<div class="col-md-6">\n' +
                '    <div class="form-group">\n' +
                '        <label for=""></label>\n' +
                '        <i class="desc-info fa fa-info-circle" data-toggle="tooltip" data-placement="left" data-animation="true" title=""></i>\n' +
                '        <input type="" name="" id="" value="" class="form-control text" data-valid="1" data-value="">\n' +
                '        <div class="message-container" style="height: 0; opacity: 1; overflow: hidden;"></div>\n' +
                '    </div>\n' +
                '</div>\n'
            );

        },

        checkbox : function ( ) {

            return $(
                '<div class="col-md-6">\n' +
                '    <div class="form-group">\n' +
                '        <div class="custom-control custom-switch">\n' +
                '            <input type="" name="" id="" value="" class="custom-control-input" data-valid="">\n' +
                '            <label class="custom-control-label font-w400" for=""></label>\n' +
                '            <i class="desc-info fa fa-info-circle" data-toggle="tooltip" data-placement="left" data-animation="true" title=""></i>\n' +
                '        </div>\n' +
                '        <div class="message-container" style="height: 0; opacity: 1; overflow: hidden;"></div>\n' +
                '    </div>\n' +
                '</div>\n'
            );

        },

        select : function ( ) {

            return $(
                '<div class="col-md-6">\n' +
                '    <div class="form-group">\n' +
                '        <label for=""></label>\n' +
                '        <i class="desc-info fa fa-info-circle" data-toggle="tooltip" data-placement="left" data-animation="true" title=""></i>\n' +
                '        <select type="" name="" id="" value="" class="form-control form-control-lg select2" data-valid="1" data-value=""></select>\n' +
                '        <div class="message-container" style="height: 0; opacity: 1; overflow: hidden;"></div>\n' +
                '    </div>\n' +
                '</div>\n'
            );

        },

        attribute : function ( type ) {

            return $(
                '        <div class="col-md-2">\n' +
                '           <label for="" class="attribute"></label>\n' +
                '           <i class="desc-info fa fa-info-circle attribute" data-toggle="tooltip" data-placement="left" data-animation="true" title=""></i>\n' +
                '           <select type="" name="" id="" value="" class="form-control form-control-lg select2" data-valid="1" data-value="">\n' +
                '               <option value="">Select</option>' +
                '               <option value="src">SRC</option>' +
                '               <option value="crossorigin">CROSSORIGIN</option>' +
                '               <option value="href">HREF</option>' +
                '               <option value="hreflang">HREFLANG</option>' +
                '               <option value="id">ID</option>' +
                '               <option value="media">MEDIA</option>' +
                '               <option value="referrerpolicy">REFERRERPOLICY</option>' +
                '               <option value="rel">REL</option>' +
                '               <option value="sizes">SIZES</option>' +
                '               <option value="title">TITLE</option>' +
                '               <option value="type">TYPE</option>' +
                '           </select>\n' +
                '        </div>\n' +
                '        <div class="col-md-8">\n' +
                '            <label for="" class="value"></label>\n' +
                '            <i class="desc-info fa fa-info-circle value" data-toggle="tooltip" data-placement="left" data-animation="true" title=""></i>\n' +
                '            <input type="" name="" id="" value="" class="form-control text" data-valid="1" data-value="">\n' +
                '            <div class="message-container" style="height: 0; opacity: 1; overflow: hidden;"></div>\n' +
                '        </div>\n' +
                '        <div class="col-md-2">\n' +
                '            <button type="button" name="" class="btn btn-alt-light remove-' + type + '">\n'+
                '                <i class="fas fa-minus-circle button-icon"></i>\n' +
                '            </button>\n' +
                '            <div class="message-container" style="height: 0; opacity: 1; overflow: hidden;"></div>\n' +
                '        </div>\n'
            );

        }

    };
  
    $.fn.cmsOneUITemplate = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist.' );
        }    
    };
    
    $().cmsOneUITemplate();

})( jQuery );
