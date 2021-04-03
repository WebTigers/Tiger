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
 * jQuery Tiger CMS Tiger Docs Plugin
 */

(function( $ ){

    let Class = {

        anchorJS : null,

        init : function ( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //

                Class.mainMenu();

                Class.pageHeadings( $('h2, h3, h4, h5').not( '.no-menu' ) );

                Class.anchorJS = new AnchorJS();
                Class.anchorJS.add('h2, h3, h4, h5');

            });

        },

        // Docs Functions //

        mainMenu : function ( ) {

            let link = 'aside.doc_left_sidebarlist a[href="' + window.location.pathname + '"]';
            $( link ).addClass('active');
            $( link ).closest('li.nav-item').find('span.icon').trigger('click');

        },

        pageHeadings : function ( $els ) {

            $els.each( function ( i, heading ) {

                let href = Class.normalize( $(heading).html() );
                let tag = $(heading).prop('nodeName').toLowerCase();
                let link = '<a class="nav-link indent-' + tag + '" href="#' + href + '">' + $(heading).html() + '</a>';

                $("#navbar-example3").append( link );

            });

        },

        normalize : function( str ) {

            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            let from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;’";
            let to   = "aaaaaeeeeeiiiiooooouuuunc-------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9\s -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;

        }

    };
  
    $.fn.cmsTigerDocs = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().cmsTigerDocs();
    
})( jQuery );
