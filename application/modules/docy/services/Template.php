<?php
/**
 * Basic class used for storing template options and providing
 * various helper functions for populating the template with
 * random content
 *
 * @author pixelcave
 * @author WebTigers
 *
 */
class Docy_Service_Template
{

    // Common Template Vars
    public
        $name               = '',
        $version            = '',
        $theme              = '',
        $scheme             = '',

        $title              = '',
        $meta               = [],
        $links              = [],
        $inlineScripts      = [],
        $styles             = [],
        $scripts            = [],
        $headScripts        = [];

    // Blog Template Vars

    public
        $siteName           = '',
        $blog               = '',

        $update_date        = '';


    /**
     * @param $options
     * @param Zend_Db_Table_Row_Abstract|null $pageRow
     */
    public function setTemplateOptions( $options, Zend_Db_Table_Row_Abstract $pageRow = null ) {

        $optionKeys = [

            // Theme Vars //

            'name',
            'version',
            'theme',
            'scheme',

            'title',
            'meta',
            'links',
            'inlineScripts',
            'styles',
            'scripts',
            'headScripts',

            'update_date'

        ];

        foreach( $optionKeys as $key ) {

            if ( ! empty( $pageRow->$key ) ) {
                $this->$key = $pageRow->$key;
            }
            else {
                $this->$key = $options->$key;
            }

        }

        if ( ! empty( $pageRow ) && $pageRow->type === 'blog' ) {

            $this->populateBlog( $pageRow );

        }

    }

    public function populateBlog ( $pageRow ) {

        $this->blog = (object) [
            'title' => '',
            'post'  => (object) [
                'title' => ''
            ]
        ];

    }

}
