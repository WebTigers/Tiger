<?php

class Manual_View_Helper_SubNav extends Zend_View_Helper_Abstract
{
    public function subNav( )
    {
        $content = '';

        $article = Zend_Controller_Front::getInstance()->getRequest()->getParam('article');
        $file = MODULES_PATH . '/manual/docs/' . LANG . '/' . $article;

        if ( file_exists( $file ) ) {

            /** This sets all of the above public properties */
            $subHeadings = $this->getSubNav( $file );

            $content =
                '<div id="sub-nav">' .
                    '<ul>' .
                        '<li class="h3"><a href="' . $subHeadings->item( 0 )->getAttribute('name') .'">' . $subHeadings->item( 0 )->parentNode->nodeValue . '</a></li>' .
                            '<ul>';

            for ( $i = 1; $i < $subHeadings->count(); $i++ ) {
                $content .= '<li><a href="' . $subHeadings->item( $i )->getAttribute('name') .'">' . $subHeadings->item( $i )->parentNode->nodeValue . '</a></li>';
            }

            $content .=
                        '</ul>' .
                    '</ul>' .
                '</div>';

        }

        return $content;

    }

    public function getSubNav ( $file ) {

        $subHeadings = [];

        try {

            $dom = new DOMDocument();
            $dom->loadHTMLFile($file);
            $xpath = new DOMXpath($dom);
            $subHeadings = $xpath->query("//*[contains(@class,'title')]/a");

        }
        catch ( Error | Exception $e ) {

            return $e->getMessage();

        }

        return $subHeadings;

    }

    public function groom ( $str )
    {
        return $this->clean( $str );
        // return preg_replace("/^[\w ]*. |^[0-9.]*. /", "",  $this->clean( $str ) );
    }

    public function clean( $str )
    {
        $str = str_replace( "\xC2\xA0", " ",  $str );
        $str = str_replace("&nbsp;", " ", $str );
        $str = preg_replace('/\s+/', " ", $str );
        $str = trim( $str );
        return $str;
    }


}