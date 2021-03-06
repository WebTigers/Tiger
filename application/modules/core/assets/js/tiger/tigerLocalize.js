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
 * Tiger Localize
 * 
 * A convenience plugin that allows us to pull localized values from the database.
 * Utilizes the Tiger Localize Service.
 *
 * @version 2.0.0
 */

(function( $ ){

    let oParams = { service : 'Localize' };

    let oMethods = {
        
        init : function( ) {

            $( document ).ready( function() {
               
            });            

        },
        
        translate : function( value ) {
            
            oParams['method']   = 'translate';
            oParams['function'] = 'translate';
            oParams['value']    = value;
            
            return oMethods._doLocalize( oParams );
        
        },
        
        currency : function( value ) {

            oParams['method']   = 'currency';
            oParams['function'] = 'toCurrency';
            oParams['value']    = value;
            
            return oMethods._doLocalize( oParams );

        },

        number : function( value ) {

            oParams['method']   = 'format';
            oParams['function'] = 'toNumber';
            oParams['value']    = value;
            
            return oMethods._doLocalize( oParams );

        },
        
        format : function ( oValues ) {
            
            // Format calls Zend_Locale_Format::functionName( string ) to
            // return a formatted string. Pass in a function name that equates
            // to the Zend_Locale_Format::functionName.
            
            oParams['method']   = 'format';
            oParams['function'] = oValues['function'];
            oParams['value']    = oValues['value'];
            
            return oMethods._doLocalize( oParams );
            
        },

        _doLocalize : function ( oData ) {

            return JSON.parse( $.ajax({
                
                type        : "POST",
                url         : "/ajax",
                dataType    : "json",
                async       : false,
                data        : oData
                
            }).responseText );
            
        }
	
    };
  
    $.fn.tigerLocalize = function( method ) {
        if ( oMethods[method] ) {
            return oMethods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return oMethods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist.' );
        }    
    };
    
    $().tigerLocalize();

})( jQuery );
