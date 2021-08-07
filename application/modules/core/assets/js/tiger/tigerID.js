/**
 * Tiger ID
 * 
 * A convenience plugin that allows us to implement hyper-persistent super-cookies.
 * Note that this plugin uses a Cookies plugin.
 *
 * @version 2.0.0
 */

(function( $ ){

    let Class = {

        init : function ( ) {

            $(document).ready(function() {

                Class.initTID();

            });

        },

        initTID : function ( ) {

            /** Test if localStorage is available and working. */
            if ( Class.storageAvailable('localStorage' ) ) {

                if ( Cookies.get('TID') !== undefined ) {

                    /** First, check to see if we're logged in. If so, set both the localStorage and cookie TID
                    from our current logged_in user_id. Authenticated user always takes precedence. Boom. Done!
                    Metadata is hidden div element with various data- properties set from the server. */

                    if ( $('#metadata').attr('data-authenticated') === 'true' ) {
                        localStorage.setItem('TID', $('#metadata').attr('data-user-id') );
                        Cookies.set('TID', $('#metadata').attr('data-user-id'), { path: '/', expires: 365 });
                    }
                    else {

                        /** If we're not authenticated, and we have a TID in localStorage, reset the cookie from
                        localStorage if the cookie is new or different. localStorage takes precedence. */

                        if ( localStorage.getItem('TID') !== null && localStorage.getItem('TID') !== Cookies.get('TID') ) {
                            Cookies.remove('TID');
                            Cookies.set('TID', localStorage.getItem('TID'), { path: '/', expires: 365 });
                        }

                        /** If we're not authenticated and there is no existing TID in localStorage, then this is a
                        first-time guest user. Set local storage TID from the cookie TID. */

                        else if ( localStorage.getItem('TID') === null ) {
                            localStorage.setItem('TID', Cookies.get('TID'));
                        }

                    }

                }

            }

        },

        storageAvailable : function (type) {

            let storage;

            try {
                storage = window[type];
                let x = '__storage_test__';
                storage.setItem(x, x);
                let y = storage.getItem(x);
                storage.removeItem(x);
                return true;
            }
            catch( e ) {
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

    };

    $.fn.tigerID = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist.' );
        }    
    };
    
    $().tigerID();

})( jQuery );
