/**
 * jQuery Tiger Manual Plugin
 */

( function( $ ) {

    let baseTime = 400;

    let Class = {

        init : function( ) {

            $( document ).ready( function() {

                Class.initTOC();
                Class.initNAV();
                Class.initSubNAV();

                document.querySelectorAll('pre').forEach((block) => {
                    hljs.highlightElement( block );
                });

            });

        },

        initTOC : function ( event ) {

            $('ul.toc li a, div.page-nav a').on('click', function ( event ) {
                event.preventDefault();
                let $el = $(this).closest('span').next('ul');

                if ( $el.length === 0 ) {
                    window.location = '/manual/' + $(this).attr('href');
                }

                if ( $el.height() === 0 ) {
                    Class.open( $el );
                }
                else {
                    Class.close( $el );
                }

            });

        },

        initNAV : function ( event ) {

            $('div.page-nav a').on('click', function ( event ) {
                event.preventDefault();
                window.location = '/manual/' + $(this).attr('href');
            });

        },

        initSubNAV : function () {

            $('div#sub-nav a').on('click', function ( event ) {
                event.preventDefault();
                let position = $('a[name="' + $(this).attr('href') + '"]').offset().top;
                $('html, body').animate({ scrollTop: position }, 600 );
            });

        },

        open : function ( $el ) {

            let height = $el.prop('scrollHeight');
            $el.animate( { height : height }, baseTime, function() {
                $el.animate({opacity: 1}, baseTime, function (){
                    $el.css('height','auto');
                });
            });

        },

        close : function ( $el ) {

            let height = $el.prop('scrollHeight');
            $el.animate({ 'opacity': 0 }, baseTime, function(){
                $el.css('height',height);
                $el.animate({'height': 0}, baseTime);
            });

        }

    };
  
    $.fn.manualIndex = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().manualIndex();
    
} ) ( jQuery );
