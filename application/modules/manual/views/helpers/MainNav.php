<?php

class Manual_View_Helper_MainNav extends Zend_View_Helper_Abstract
{
    public function mainNav( )
    {

        $dom = new DOMDocument();
        $dom->loadHTMLFile(MODULES_PATH . '/manual/docs/' . LANG . '/index.html');
        $xpath = new DOMXpath( $dom );
        $toc = $xpath->query("//div[contains(@class,'toc')]");

        // Remove the numeric section numbers //
        foreach ( $toc as $container ) {
            $anchors = $container->getElementsByTagName("a");
            foreach( $anchors as $anchor ) {
                $anchor->nodeValue = $this->groom( $anchor->nodeValue );
            }
        }

        return $dom->saveHTML( $toc->item(0) );

    }

    public function groom ( $str )
    {
        return $this->clean( $str );
        // return htmlentities( trim( preg_replace("/^[\w ]*. |^[0-9.]*. /", "", $this->clean( $str ) ) ) ); // <-- this was used to strip chapter numbers
    }

    public function clean( $str )
    {
        $str = trim( $str );
        $str = str_replace( "\xC2\xA0", " ",  $str );
        $str = str_replace("&nbsp;", " ", $str );
        $str = preg_replace('/\s+/', " ", $str );
        return $str;
    }

}