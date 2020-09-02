/**
 * jQuery Tiger DOM Plugin
 * 
 * Tiger DOM is a multi-function jQuery plugin that allows you to do
 * a multitude of things elegantly.
 * 
 * Version 1.0.6
 * 
 * ChangeLog
 * 
 * Version 1.0.6 Fixed container heights with elements using top and bottom margins.
 * Version 1.0.5 Added Count function
 * Version 1.0.4 Fixed initToggleControls page jumping with preventDefault()
 *               Fixed issue with heights in nested toggled containers
 * Version 1.0.3 Added animateCount Method
 * Version 1.0.2 Added InitToggleControls Method
 * Version 1.0.1 Added Open & Close Methods
 * Version 1.0.0 Initial Insert, Change, Remove Methods
 */

(function( $ ){
    
    //
    var _locale;
    
    // The baseTime is the speed of all animations within the plugin
    var baseTime        = 400;
    var baseTimeFast    = 200;
    
    var oMethods = {
        
        init : function() {

            $(document).ready(function() {

                // set Locale
                oMethods.setLocale();

            });

        },

        /**
         * Returns the current locale of the client as set by the server.
         */
        getLocale : function() {
            return _locale;
        },
        
        /**
         * Sets the locale from the browsers meta http-equiv Content-Language 
         * variable as set by the server.
         * 
         */
        setLocale : function( ) {
            _locale = $('meta[http-equiv=Content-Language]').attr("content");
        },

        /**
         * Animates the count, up or down, of any numbers
         * Call this function like this:
         * 
         * $().tigerDOM('animateCount', {
         *      begin    : some_number,
         *      end      : another_number, 
         *      callback : function(c){ console.log( c ); } 
         *  });
         *  
         */
        animateCount : function ( oParams ) {  
        
            var from = { count : oParams.begin };
            var to   = { count : oParams.end };
            
            $(from).animate(to, {
                duration: baseTime,
                step: function(a,b) {
                    oParams.callback(Math.round(this.count));
                },
                complete: function () {
                    oParams.callback( oParams.end );
                }
            });
        },

        /**
         * Container Controls
         * 
         * Searches the DOM looking for the attribute:
         * 
         *     data-tiger-control="#container-element" 
         *     
         * The target then becomes the control for toggling (opening and 
         * closing the target container. Sweet!
         * 
         * If the state of the control is to be hidden, set the container
         * element to display:none with a class named "hide".
         * 
         *     .hide { display: none; }
         * 
         * Initialize the toggle controls in your JS like this:
         * 
         *     $().tigerDOM('initToggleControls');
         * 
         */
        initToggleControls : function ( ) {
            
            $('[data-tiger-control]').each(function(){
            
                var $target = $($(this).attr('data-tiger-control'));
                $target.css('overflow', 'hidden')
                       .height(0)
                       .css('opacity', 0)
                       .removeClass('hide');

                $(this).on('click', {target:$target}, function( e ){
                    e.preventDefault();
                    if ($target.height() == 0) { 
                        $target.tigerDOM('open'); 
                    } else {
                        $target.tigerDOM('close'); 
                    }
                });    
            });
            
        },

        /**
         * Counts the number of properties (keys) in an array
         */
        count : function( obj ) {
            var count = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) { count++; }
            }
            return count;
        },
        
        /**
         * A utility function that sets all of the passed in 
         * elements to the same height as the tallest element
         */
        equalHeights : function( ) {
            
            var tallest = 0;

            $(this).each( function() {
                
                    var thisHeight = $(this).height();
                    if(thisHeight > tallest) {
                            tallest = thisHeight;
                    }
            });

            $(this).height(tallest);
        },

        parse_url : function( oParams ) {
            
                //       discuss at: http://phpjs.org/functions/parse_url/
                //      original by: Steven Levithan (http://blog.stevenlevithan.com)
                // reimplemented by: Brett Zamir (http://brett-zamir.me)
                //         input by: Lorenzo Pisani
                //         input by: Tony
                //      improved by: Brett Zamir (http://brett-zamir.me)
                //             note: original by http://stevenlevithan.com/demo/parseuri/js/assets/parseuri.js
                //             note: blog post at http://blog.stevenlevithan.com/archives/parseuri
                //             note: demo at http://stevenlevithan.com/demo/parseuri/js/assets/parseuri.js
                //             note: Does not replace invalid characters with '_' as in PHP, nor does it return false with
                //             note: a seriously malformed URL.
                //             note: Besides function name, is essentially the same as parseUri as well as our allowing
                //             note: an extra slash after the scheme/protocol (to allow file:/// as in PHP)
                //        example 1: parse_url('http://username:password@hostname/path?arg=value#anchor');
                //        returns 1: {scheme: 'http', host: 'hostname', user: 'username', pass: 'password', path: '/path', query: 'arg=value', fragment: 'anchor'}

                var str         = oParams.uri, 
                    component   = oParams.component;

                var query, key = ['source', 'scheme', 'authority', 'userInfo', 'user', 'pass', 'host', 'port', 'relative', 'path', 'directory', 'file', 'query', 'fragment' ],
                    ini = (this.php_js && this.php_js.ini) || {},
                    mode = (ini['phpjs.parse_url.mode'] &&
                        ini['phpjs.parse_url.mode'].local_value) || 'php',
                        parser = {
                        php: /^(?:([^:\/?#]+):)?(?:\/\/()(?:(?:()(?:([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?()(?:(()(?:(?:[^?#\/]*\/)*)()(?:[^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
                                strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
                                loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/\/?)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ // Added one optional slash to post-scheme to catch file:/// (should restrict this)
                        };
                        var m = parser[mode].exec(str),
                        uri = {},
                        i = 14;
                        while (i--) {
                if (m[i]) {
                uri[key[i]] = m[i];
                }
                }

                if (component) {
                return uri[component.replace('PHP_URL_', '')
                        .toLowerCase()];
                }
                if (mode !== 'php') {
                var name = (ini['phpjs.parse_url.queryKey'] &&
                        ini['phpjs.parse_url.queryKey'].local_value) || 'queryKey';
                        parser = /(?:^|&)([^&=]*)=?([^&]*)/g;
                        uri[name] = {};
                        query = uri[key[12]] || '';
                        query.replace(parser, function ($0, $1, $2) {
                        if ($1) {
                        uri[name][$1] = $2;
                        }
                        });
                }
                delete uri.source;
                return uri;
        },        

        /* ============ TIGER Elegant DOM Functions ============ */

        /**
         * TIGER Elegant Show
         * 
         * Fades in an element with hide or hidden display: none; class.
         * 
         * Pass in a callback function to automatically call the function
         * once the animation completes.
         */
        show : function ( callback ) {
            
            return this.each(function(){

                var $this = $(this);
                
                    $this.css('opacity', 0)
                    .removeClass('hide')
                    .removeClass('hidden')
                    .animate({opacity: 1}, baseTime, callback);               
               
            });
            
        },

        /**
         * TIGER Elegant Hide
         * 
         * Fades out an element.
         * 
         * Pass in a callback function to automatically call the function
         * once the animation completes.
         */
        hide : function ( callback ) {
            
            return this.each(function(){

                var $this = $(this);
                
                    $this.animate({opacity: 0}, baseTime, callback);               
               
            });
            
        },

        /**
         * TIGER Elegant Open
         * 
         * Opens the container element with a smooth animation
         * and then fades in the invisible content.
         * 
         * NOTE: the Target container element's CSS needs to be 
         * set to "overflow:hidden;"
         */
        open : function ( callback ) {
            
            var fnCallback = (typeof callback === 'function') ? callback : null;
            
            return this.each(function(){
                
                var $this = $(this);
                
                $this.removeClass( 'hide' );
                var height = parseInt( $this.prop('scrollHeight'), 10 );

                $this
                    .css( 'opacity' , 0 )
                    .css( 'height'  , 0 )
                    .css( 'overflow', 'hidden' );
                
                // Expand the target container to accomodate the hidden content
                $this.animate( { height : height }, baseTime, function(){
                    // Now make the content visible
                    $this.animate( { opacity : 1 }, baseTime, function(){
                        $this.css( 'height', '' ).css( 'overflow', '');
                        fnCallback;
                    });
                });
                
            });

        },

        /**
         * TIGER Elegant Close
         * 
         * Fades out the container contents and then closes the
         * container with a smooth animation.
         * 
         * NOTE: the Target container element's CSS needs to be 
         * set to "overflow:hidden;"
         */
        close : function ( callback ) {
            
            callback = (typeof callback == 'function') 
                ? callback 
                : null;
                
            return this.each(function(){
                
                var $this = $(this);
                
                return $this.css('overflow', 'hidden').animate({
                        'opacity': 0
                        }, baseTime, function(){
                            $this.animate({
                                'height': 0
                                }, baseTime, callback);
                });
                
            });
        },

        /**
         * TIGER Elegant Insert
         * 
         * Insert elegantly inserts content into a container (target) 
         * based on the oParams set.
         * 
         * var oMessage = { 
         *      content       : '',
         *      removeClick   : false,
         *      removeTimeout : 0
         * };
         * 
         * NOTE: the Target container element's CSS needs to be 
         * set to "overflow:hidden;"
         */
        insert : function( oParams ) { 

            var callback = (typeof oParams.callback == 'function') 
                ? oParams.callback 
                : null;

            return this.each(function(){
                var $this = $(this);

                // Get the current height of the parent container element 
                // var parentHeight = parseInt($this.innerHeight(), 10) + 1;
                var parentHeight = $this.innerHeight();
                
                // console.log( parentHeight );
                
                // Now specifically set the height of container element
                $this.css('height', parentHeight).css('overflow', 'auto');

                // Create and insert the content
                var $content = $( oParams.content )
                        .css('opacity', 0)
                        .appendTo( $this );

                // Calculate what the total height of the container needs to be
                // var containerHeight = parentHeight + parseInt($content.outerHeight(), 10);
                var minHeight = parseInt( $this.css('min-height'), 10 );
                
                $this.css('height', 'auto');
                var containerHeight = $this.innerHeight();
                
                // console.log( containerHeight );
                
                $this.css('overflow','hidden').css('height', parentHeight);
                
                /*
                $this.children().each( function(){
                    containerHeight += $(this).outerHeight() 
                        + parseInt($(this).css('margin-top'),10) 
                        + parseInt($(this).css('margin-bottom'),10);
                });
                */
               
                containerHeight = ( minHeight > 0 && minHeight > containerHeight) 
                    ? minHeight 
                    : containerHeight;
                
                // Expand/contract the target container to accomodate the new invisible content
                $this.animate({
                        'height' : containerHeight
                        }, baseTime, function(){
                            $content.animate({
                                opacity: 1
                            }, baseTime, callback );
                });
                
                // Attach a removeClick listener (optional)
                if (oParams.removeClick && oParams.removeClick === true) {
                    $content
                        .addClass('pointer')
                        .bind('click', function( event ){
                            $this = $(this);
                            $this.tigerDOM('remove');
                        });
                }
                
                // Attach a removeTimeout listener (optional)
                if (oParams.removeTimeout && oParams.removeTimeout > 0) {
                    setTimeout( function( ){$content.tigerDOM('remove');}, oParams.removeTimeout );
                }
                
            });

        },

        /**
         * TIGER Elegant Remove
         * 
         * Remove function elegantly deletes content (targeted elements).
         */
        remove : function( callback ) {
            
            callback = (typeof callback === 'function') 
                ? callback 
                : null;

            return this.each(function(){
                
                var $content = $(this);
                var contentHeight = $content.outerHeight();
                    
                var $parent  = $content.parent();
                var parentHeight = $parent.innerHeight();

                var height = parseInt(parentHeight - contentHeight, 10);
                var adjustedHeight = ($parent.children().length > 0 ) ? height : 1;
                var minHeight = parseInt( $parent.css('min-height'), 10 );
                
                adjustedHeight = ( minHeight > 0 ) ? minHeight : adjustedHeight;
                
                // set an element static height on the container
                $parent.css('height', parentHeight);
                
                return $content.animate({'opacity': 0}, baseTime, function(){
                        $content.css('height', $content.height).css('overflow', 'hidden');
                        $content.animate({'height': 0 }, baseTime, function(){ 
                            // Prevent browsers like Chrome from collapsing empty elements
                            if ( adjustedHeight == 0 ) { $parent.css('margin-bottom', '1px') }
                            $content.remove();
                            return $parent.animate( {'height': adjustedHeight}, baseTime, callback );                        
                        });
                });

                
            });
        
        },

        /**
         * TIGER Elegant Change
         * 
         * Sometimes we want to elegantly change (remove and then insert) 
         * the content. Target the parent with the oParams content (see 
         * insert for the params object).
         * 
         * NOTE: See insert() function for oParams.
         */
        change : function ( oParams ) {
          
            return this.each(function(){
                
                var $target = $(this);
                
                // fade out all the kids
                if ($target.children().length > 0) {
                    
                    // Set the parent height so it doesn't change 
                    // height when children are removed
                    $target.css('height', $target.innerHeight());

                    // Queue fadeOut of any children
                    $target.queue('change', function(next){
                        $target.children().each(function(){ 
                            $(this).fadeOut(baseTime, function(){ 
                                next(); 
                            }); 
                        });
                    });
                    
                    //Queue removal of any children
                    $target.queue('change', function(next){
                        $target.children().each( function(){ $(this).remove(); } );
                        // $target.css('height', '1px');
                        next();
                    });

                    //Queue removal of any children
                    $target.queue('change', function(next){
                        $target.tigerDOM('insert', oParams);
                        next();
                    });

                    if ( typeof oParams.change_callback == 'function' ) { 
                        $target.queue('change', function(next){
                            oParams.change_callback( oParams ); 
                            next();
                        });
                    }
                    
                    $target.dequeue('change');
    
                } else {
                    
                    $target.tigerDOM('insert', oParams);
                
                }
                
            });
          
        },

        /**
         * TIGER Elegant Switch
         * 
         * Sometimes we want to elegantly change (hide and then show) 
         * the content within a container. Target the parent with the 
         * oParams content (see insert for the params object). Make sure
         * there is no margin on the content_parent for a more smooth 
         * animation.
         * 
         * var oMessage = { 
         *      out      : content_parent,
         *      in       : content_parent,
         *      callback : function
         * };
         * 
         */
        switch : function ( oParams ) {
          
            var callback = (typeof oParams.callback === 'function') 
                ? oParams.callback 
                : null;
          
            return this.each(function(){
                
                var $target = $(this);
                var $out    = $(oParams.out);
                var $in     = $(oParams.in);
                
                // Set the parent height so it doesn't change 
                // height when the out content is hidden
                $target.css('height', $target.innerHeight() ).css('overflow', 'hidden');

                // Queue fadeOut of the out content
                $target.queue('switch', function(next){
                    $in.css('opacity', 0);
                    $out.fadeOut(baseTimeFast, function(){
                        $out.addClass('hide');
                        next(); 
                    }); 
                });

                // Queue adjust the height of the parent container
                $target.queue('switch', function(){

                    $in.removeClass('hide');

                    // Calculate what the total height of the incoming container
                    var minHeight = parseInt($in.css('min-height'), 10);
                    var containerHeight = 0;

                    containerHeight = $in.outerHeight()
                            + parseInt($in.css('margin-top'), 10)
                            + parseInt($in.css('margin-bottom'), 10);

                    containerHeight = (minHeight > 0 && minHeight > containerHeight)
                            ? minHeight
                            : containerHeight;

                    // Expand / contract the target container to accomodate the 
                    // in content and then run the callback. Done!
                    $target.animate({'height': containerHeight}, baseTimeFast, function () {
                        $in.css('display', '').animate({opacity: 1}, baseTimeFast, function(){ 
                            $target.css('height', '').css('overflow', '');
                            callback 
                        });
                    });

                });

                $target.dequeue('switch');
                
            });
          
        },
        
        /**
         * Resets the height and opacity of closed
         * @returns null
         */
        reset : function ( ) {
            
            $(this)
                    .css('height','auto')
                    .css('opacity','1')
                    .removeClass('hide')
                    .removeClass('hidden');
            
        }

    };
  
    $.fn.tigerDOM = function( method ) {
        if ( oMethods[method] ) {
            return oMethods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return oMethods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.tigerDOM' );
        }    
    };
    
    $().tigerDOM();

})( jQuery );

function storageAvailable(type) {
    let storage;
    try {
        storage = window[type];
        let x = '__storage_test__';
        storage.setItem(x, x);
        let y = storage.getItem(x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return e instanceof DOMException && (
                // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            (storage && storage.length !== 0);
    }
}