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
 * jQuery Tiger Form Wizard Plugin
 */

(function( $ ){
    
    let Class = {

        // Class Defaults //

        form            : null,
        wizard          : null,
        tabCount        : null,
        active          : 1,

        nextSelector    : '[data-wizard="next"]',
        prevSelector    : '[data-wizard="prev"]',
        finishSelector  : '[data-wizard="finish"]',

        nextButton      : null,
        prevButton      : null,
        finishButton    : null,


        // Init //

        init : function( ) {

            $(document).ready(function() {

            });

        },

        // Attach Tabbed Form //

        initFormWizard : function ( params ) {

            // Get Nav-tabs instance //

            Class.form          = $( params.form );
            Class.wizard        = $( params.tabs );
            Class.tabCount      = Class.wizard.children('li').length;
            Class.prevButton    = $( params.prevButton );
            Class.nextButton    = $( params.nextButton );
            Class.finishButton  = $( params.finishButton );
            Class.progressBar   = Class.wizard.parent().find('[data-wizard="progress"] .progress-bar');

            Class.prevButton.on( 'click', Class.prev );
            Class.nextButton.on( 'click', Class.next );
            Class.finishButton.on( 'click', Class.finish );

            Class.wizard.find('a.nav-link').on('click', Class.tab );

            Class.tabShow();

        },

        tabShow : function ( event ) {

            if ( Class.active === 1 ) {
                Class.prevButton.addClass('disabled').prop('disabled', true);
                Class.finishButton.addClass('hide').prop('disabled', true);
                Class.nextButton.removeClass('hide').removeClass('disabled').prop('disabled', false);
            }
            else if ( Class.active === Class.tabCount ) {
                Class.nextButton.addClass('hide').addClass('disabled').prop('disabled', true);
                Class.finishButton.removeClass('hide').prop('disabled', false);
            }
            else {
                Class.prevButton.removeClass('disabled').prop('disabled', false);
                Class.nextButton.removeClass('hide').removeClass('disabled').prop('disabled', false);
                Class.finishButton.addClass('hide').prop('disabled', true);
            }

            Class.wizard.find( 'li:nth-child(' + Class.active + ') a' ).tab('show');

            Class.progress();

        },

        progress : function ( ) {
            let width = ( Class.active / Class.tabCount ) * 100;
            Class.progressBar.css('width', width + '%');
        },

        tab : function ( event ) {
            Class.active = $(event.target).parent().index() + 1;
            Class.tabShow();
        },

        prev : function ( event ) {
            Class.active--;
            Class.tabShow();
        },

        next : function ( event ) {
            Class.active++;
            Class.tabShow();
        },

        finish : function ( event ) {

        }


    };
  
    $.fn.tigerFormWizard = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().tigerFormWizard();
    
})( jQuery );
