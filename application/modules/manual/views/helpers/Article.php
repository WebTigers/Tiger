<?php

class Manual_View_Helper_Article extends Zend_View_Helper_Abstract
{
    public $title       = '';
    public $prevHref    = '';
    public $prevTitle   = '';
    public $nextHref    = '';
    public $nextTitle   = '';

    public function article( )
    {
        $content = '';

        $article = Zend_Controller_Front::getInstance()->getRequest()->getParam('article');
        $file = MODULES_PATH . '/manual/docs/' . LANG . '/' . $article;

        if ( file_exists( $file ) ) {

            $article = $this->getArticle( $file );

            $navPrev = ( ! empty( $this->prevTitle ) )
                ? '<ul><li class="prev"><a href="' . $this->prevHref . '"><i class="fas fa-angle-double-left"></i> ' .  $this->prevTitle . '</a></li>'
                : '<ul><li class="prev"></li>';

            $navNext = (  ! empty( $this->nextTitle ) )
                ? '<li class="next"><a href="' . $this->nextHref . '">' . $this->nextTitle . ' <i class="fas fa-angle-double-right"></i></a></li></ul>'
                : '<li class="next"></li></ul>';

            $nav = $navPrev . $navNext;

            $navTop = '<div class="page-nav page-nav-top">'. $nav . '</div>';
            $navBottom = '<div class="page-nav page-nav-bottom">'. $nav . '</div>';

            $content = $navTop . $article . $navBottom;

        }

        return $content;

    }

    public function getArticle ( $file ) {

        try {

            $dom = new DOMDocument();
            $dom->loadHTMLFile($file);
            $xpath = new DOMXpath($dom);

            $article    = $xpath->query("//body/div[contains(@class,'part') or contains(@class,'chapter') or starts-with(@class,'sect1') or contains(@class,'book') or contains(@class,'appendix')]");
            $headings   = $xpath->query("(//h1[contains(@class,'title')]) | (//h2[contains(@class,'title')]) | (//h3[contains(@class,'title')]) | (//h4[contains(@class,'title')])");

            foreach ( $headings as $heading ) {
                // $heading->nodeValue = htmlspecialchars( $this->groom( $heading->nodeValue ) );
            }

            $this->title        = $headings->item(0)->nodeValue;

            $result             = $xpath->query("//a[contains(@accesskey,'n')]");
            $this->nextHref     = ( ! empty( $result->item(0) ) ) ? $result->item(0)->getAttribute('href') : '';

            $result             = $xpath->query("//div[contains(@class,'navfooter')]/table/tr[2]/td[3]");
            $this->nextTitle    = ( ! empty( $result->item(0) ) ) ?$this->groom( $result->item(0)->nodeValue ) : '';

            $result             = $xpath->query("//a[contains(@accesskey,'p')]");
            $this->prevHref     = ( ! empty( $result->item(0) ) ) ? $result->item(0)->getAttribute('href') : '';

            $result             = $xpath->query("//div[contains(@class,'navfooter')]/table/tr[2]/td[1]");
            $this->prevTitle    = ( ! empty( $result->item(0) ) ) ? $this->groom( $result->item(0)->nodeValue ) : '';

            $html = $dom->saveHTML( $article->item(0) );

        }
        catch ( Error | Exception $e ) {

            return $e->getMessage();

        }

        return $html;

    }

    public function groom ( $str )
    {
        return $this->clean( $str );
        // return preg_replace("/^[\w ]*. |^[0-9.]*. /", "",  $this->clean( $str ) ); // <-- this was used to strip chapter numbers
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