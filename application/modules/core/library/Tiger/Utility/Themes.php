<?php

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

class Tiger_Utility_Themes {

    public static function isTheme ( $theme ) {

        $themesArr = self::getThemeNames();
        return in_array($theme, $themesArr);

    }

    public static function getThemeConfig ( $theme ) {

        return Zend_Registry::get('Zend_Config')->themes->{$theme};

    }

    public static function getThemeNames ( ) {

        $out = [];
        foreach( self::getThemesList() as $name => $theme ) {
            $out[] = $name;
        }
        return $out;

    }

    public static function getThemesList ( ) {

        return Zend_Registry::get('Zend_Config')->themes;

    }

    public static function getLayoutList ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->layouts ) ) {

            /**
             * Layouts are an array ...
             *
             *  [
             *      layoutname => [
             *          name => "LABEL.LAYOUT_NAME",    <-- Gets Translated, not sure why, it's a label.
             *          path => "filename"              <-- Filename of the layout without the extension.
             *      ],
             *      ...
             *  ]
             *
             */

            /** Get options from config. */
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->layouts->toArray();

            /** Get options from the database. */
            $pageModel = new Cms_Model_Page;
            $layoutsRowset = $pageModel->getLayoutsForSelect2( $theme );

            foreach( $layoutsRowset as $layout ) {
                $out[ $layout->key ] = [
                    "name" => $layout->name,
                    "path" => $layout->key,
                ];
            }

        }

        return $out;

    }

    public static function getSchemeList ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->options->{'css-scheme'} ) ) {
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->options->{'css-scheme'};
        }
        return $out;

    }

    public static function getThemeMeta ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->meta ) ) {
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->meta->toArray();
        }
        return $out;

    }

    public static function getThemeHeadLinks ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->links ) ) {
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->links->toArray();
        }
        return $out;

    }

    public static function getThemeHeadScripts ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->headScripts ) ) {
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->headScripts->toArray();
        }
        return $out;

    }

    public static function getThemeInlineScripts ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->inlineScripts ) ) {
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->inlineScripts->toArray();
        }
        return $out;

    }

    public static function getThemeTemplates ( $params ) {

        $theme = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';

        /** Templates are static theme files. */

        $out = [];
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->templates ) ) {
            $out = Zend_Registry::get('Zend_Config')->themes->{$theme}->templates;
        }
        return $out;

    }

    public static function getThemeTemplateContent ( $params ) {

        $theme      = ( ! empty( $params['theme'] ) ) ? $params['theme'] : '';
        $template   = ( ! empty( $params['template'] ) ) ? $params['template'] : '';

        /** Templates are static theme files. */

        $out = null;
        if ( self::isTheme( $theme ) && isset( Zend_Registry::get('Zend_Config')->themes->{$theme}->templates->{$template} ) ) {

            $filename = Zend_Registry::get('Zend_Config')->themes->{$theme}->templates->{$template}->filename;
            $filepath = MODULES_PATH . '/' . $theme . '/templates/' . $filename;
            if ( file_exists( $filepath ) ) {
                $out = file_get_contents( $filepath );
            }

        }
        return $out;

    }

}
