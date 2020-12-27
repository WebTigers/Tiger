<?php

 trait Core_Service_ContentTrait {
    /**
     * Set Page Meta
     *
     * @param $view
     * @param $pageRow
     */
    public function setPageMeta ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        foreach( $view->template->meta->toArray() as $metaType => $metaData ) {

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
     * @param $pageRow
     */
    public function setPageLinks ( & $view ) {

        foreach( $view->template->links as $linkName ) {
            $view->headLink( $linkName->attributes->toArray(), 'APPEND' );
        }

    }

    /**
     * Sets inline JS scripts.
     * These will usually be rendered at the bottom of the page body.
     *
     * @param $view
     * @param $pageRow
     * @return null
     */
    public function setInlineScripts ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        foreach( $view->template->inlineScripts->toArray() as $script ) {
            if ( ! empty( $script['href'] ) ) {
                $view->inlineScript()->appendFile( Tiger_Cache::version( $script['href'] ) );
            }
        }

    }

    /**
     * Set Head Styles
     *
     * @param $view
     */
    public function setHeadStyles ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        foreach( $view->template->headStyles->toArray() as $style ) {
            if ( ! empty( $style ) ) {
                $view->headStyle()->appendStyle( $style );
            }
        }

    }

    /**
     * Set Head Scripts
     *
     * @param $view
     */
    public function setHeadScripts ( & $view ) {

        /** Note that $view->template->options will have all of the default config data for the theme. */

        foreach( $view->template->headScripts->toArray() as $script ) {
            if ( ! empty( $script ) ) {
                $view->headScript()->appendScript( $script );
            }
        }

    }

}