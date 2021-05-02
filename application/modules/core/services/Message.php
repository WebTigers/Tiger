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

class Core_Service_Message
{
    public static function translate ( $key )
    {
        return Zend_Registry::get('Zend_Translate')->translate( $key );
    }


    public static function sendUserWelcomeEmail ( $userRow )
    {

        // The Plain-text Portion (boring!)
        $text    = self::translate( 'MAIL.WELCOME.LINE_1' ) . "\n\n";
        $text   .= self::translate( 'MAIL.WELCOME.LINE_2' ) . "\n\n";
        $text   .= self::translate( 'MAIL.WELCOME.LINE_3' ) . "\n\n";
        $text   .= "\n\n";
        $text   .= self::translate( 'MAIL.WELCOME.LINE_4' ) . "\n\n";

        // The HTML Portion (super-awesome!)
        $view = new Zend_View();
        $view->setScriptPath( Zend_Registry::get('Zend_Config')->mail->templateScriptPath );
        $view->assign( 'site', Zend_Registry::get('Zend_Config')->site );
        $view->assign( 'user', $userRow );
        $html = $view->render( 'welcome.phtml' );

        $mail = new Zend_Mail();
        $mail->setFrom( Zend_Registry::get('Zend_Config')->mail->fromAddress, self::translate( 'MAIL.FROM_NAME') );
        $mail->addTo( $userRow->email );
        $mail->setSubject( self::translate( 'MAIL.WELCOME.SUBJECT' ) );
        $mail->setBodyText( $text );
        $mail->setBodyHtml( $html );
        $mail->send();

    }

    public static function sendUserVerifyEmail ( $userRow )
    {

        // Now send New Account Verification Email
        $activation_link = "http://" . $_SERVER['HTTP_HOST'] . "/account/verify/key/" . $userRow->email_verify_key;

        // The Plain-text Portion (boring!)
        $text    = self::translate( 'MAIL.VERIFY.TEXT_LINE_1' ) . "\n\n";
        $text   .= self::translate( 'MAIL.VERIFY.TEXT_LINE_2' ) . "\n\n";
        $text   .= self::translate( 'MAIL.VERIFY.TEXT_LINE_3' ) . "\n\n";
        $text   .= "\n\n";
        $text   .= $activation_link;
        $text   .= "\n\n";
        $text   .= self::translate( 'MAIL.VERIFY.TEXT_LINE_4' ) . "\n\n";
        $text   .= "\n\n";
        $text   .= self::translate( 'MAIL.VERIFY.TEXT_LINE_5' ) . "\n\n";

        // The HTML Portion (super-awesome!)
        $view = new Zend_View();
        $view->setScriptPath( Zend_Registry::get('Zend_Config')->mail->templateScriptPath );
        $view->assign( 'site', Zend_Registry::get('Zend_Config')->site );
        $view->assign( 'activation_link', $activation_link );
        $html = $view->render( 'verify.phtml' );

        $mail = new Zend_Mail();
        $mail->setFrom( Zend_Registry::get('Zend_Config')->mail->fromAddress, self::translate( 'MAIL.FROM_NAME' ) );
        $mail->addTo( $userRow->email );
        $mail->setSubject( self::translate( 'MAIL.VERIFY.SUBJECT' ) );
        $mail->setBodyText( $text );
        $mail->setBodyHtml( $html );
        $mail->send();

    }

    public static function sendUserRecoverEmail ( $userRow )
    {

        // Now send New Account Verification Email
        $login_link = "http://" . $_SERVER['HTTP_HOST'] . "/password/username/" . $userRow->username . '/password/' . $userRow->password_reset_key;

        // The Plain-text Portion (boring!)
        $text    = self::translate( 'MAIL.RECOVER.TEXT_LINE_1' ) . "\n\n";
        $text   .= self::translate( 'MAIL.RECOVER.TEXT_LINE_2' ) . "\n\n";
        $text   .= self::translate( 'MAIL.RECOVER.TEXT_LINE_3' ) . "\n\n";
        $text   .= "\n\n";
        $text   .= $login_link;
        $text   .= "\n\n";
        $text   .= self::translate( 'MAIL.RECOVER.TEXT_LINE_4' ) . "\n\n";
        $text   .= "\n\n";
        $text   .= self::translate( 'MAIL.RECOVER.TEXT_LINE_5' ) . "\n\n";

        // The HTML Portion (super-awesome!)
        $view = new Zend_View();
        $view->setScriptPath( Zend_Registry::get('Zend_Config')->mail->templateScriptPath );
        $view->assign( 'site', Zend_Registry::get('Zend_Config')->site );
        $view->assign( 'login_link', $login_link );
        $html = $view->render( 'recover.phtml' );

        $mail = new Zend_Mail();
        $mail->setFrom( Zend_Registry::get('Zend_Config')->mail->fromAddress, self::translate( 'MAIL.FROM_NAME' ) );
        $mail->addTo( $userRow->email );
        $mail->setSubject( self::translate( 'MAIL.RECOVER.SUBJECT' ) );
        $mail->setBodyText( $text );
        $mail->setBodyHtml( $html );
        $mail->send();

    }



    public static function sms ( $phone, $message ) {

        // Send an SMS message to Admin //

        $sms = new Tiger_Nexmo_Message();
        return $sms->sendMessage( '1' . $phone, $message );

    }

}