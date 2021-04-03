<?php

trait Core_Service_ContentTrait {
    /**
     * Set Page Meta
     *
     * @param $view
     * @return null
     */
    public function setMeta ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        if ( $view->template->meta instanceof Zend_Config ) {
            $view->template->meta = $view->template->meta->toArray();
        }
        elseif ( is_json( $view->template->meta ) ) {
            $view->template->meta = json_decode( $view->template->meta, true );
        }
        else {
            $view->template->meta = [];
        }

        // pr( Zend_Registry::get('Zend_Config')->themes->canvas->meta->toArray() );
        // pr( $view->template->meta );

        foreach( $view->template->meta as $metaType => $metaData ) {

            foreach( $metaData as $m => $metaName ) {

                foreach ( $metaName['attributes'] as $attribute => $value ) {

                    if ( ! empty( $value ) ) {

                        if ( $metaType === 'charset' ) {
                            // Only works with Doctype set to "HTML5".
                            $view->headMeta()->setCharset($value);
                        }
                        elseif ($metaType === 'http-equiv') {
                            $view->headMeta()->appendHttpEquiv($attribute, $value);
                        }
                        elseif ($metaType === 'opengraph') {
                            // Only works with Doctype set to "HTML5".
                            // We cannot use ":" in the static .ini config, so we string replace "-" if necessary.
                            $view->headMeta()->setProperty(str_replace('-', ':', $attribute), $value);
                        }
                        else {
                            $view->headMeta()->appendName($attribute, $value);
                        }

                    }

                }

            }

        }

    }

    /**
     * Set Page Links
     *
     * @param $view
     * @return null
     */
    public function setLinks ( & $view ) {

        if ( $view->template->links instanceof Zend_Config ) {
            $view->template->links = $view->template->links->toArray();
        }
        elseif ( is_json( $view->template->links ) ) {
            $view->template->links = json_decode( $view->template->links, true );
        }
        else {
            $view->template->links = [];
        }

        foreach( $view->template->links as $linkName ) {
            $view->headLink( $linkName['attributes'], 'APPEND' );
        }

    }

    /**
     * Set Head Styles
     *
     * @param $view
     */
    public function setStyles ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

       if ( ! empty( $view->template->styles ) ) {
           $view->headStyle()->appendStyle( $view->template->styles );
       }

    }

    /**
     * Set Head Styles
     *
     * @param $view
     */
    public function setScripts ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        if ( ! empty( $view->template->scripts ) ) {
            $view->inlineScript()->appendScript( $view->template->scripts );
        }

    }

    /**
     * Set Head Scripts
     *
     * @param $view
     * @return null
     */
    public function setHeadScripts ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        if ( $view->template->headScripts instanceof Zend_Config ) {
            $view->template->headScripts = $view->template->headScripts->toArray();
        }
        elseif ( is_json( $view->template->headScripts ) ) {
            $view->template->headScripts = json_decode( $view->template->headScripts, true );
        }
        else {
            $view->template->headScripts = [];
        }

        foreach( $view->template->headScripts as $script ) {

            if ( is_array( $script ) ) {
                $view->headScript()->appendFile( $script['attributes']['src'], $script['attributes']['type'], $script['attributes'] );
            }

        }

    }

    /**
      * Sets inline JS scripts.
      * These will usually be rendered at the bottom of the page body.
      *
      * @param $view
      * @return null
      */
    public function setInlineScripts ( & $view ) {

         /** Note that $view->template->options will have all of the default config data for the theme. */

         if ( $view->template->inlineScripts instanceof Zend_Config ) {
             $view->template->inlineScripts = $view->template->inlineScripts->toArray();
         }
         elseif ( is_json( $view->template->inlineScripts ) ) {
             $view->template->inlineScripts = json_decode( $view->template->inlineScripts, true );
         }
         else {
             $view->template->inlineScripts = [];
         }

         foreach( $view->template->inlineScripts as $script ) {

             if ( is_array( $script ) ) {
                 $view->inlineScript()->appendFile( $script['attributes']['src'], $script['attributes']['type'], $script['attributes'] );
             }

         }

     }

}