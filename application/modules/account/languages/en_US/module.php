<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS / TIGER PLATFORM
 * Language Translation Keys
 * Account Module Templates and Messages
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [

    // Tiger Setup //
    'FORM.TIGER_SETUP' => 'Tiger Setup',
    'HEADER.SETUP_WELCOME' => 'Welcome!',
    'HEADER.SETUP_INITIAL' => 'Tiger Initial Setup',
    'HEADER.SETUP_OVERVIEW' => 'If this is your first time using TIGER, we just need to make a few changes to the TIGER setup to make your instance more secure. Click each of the tabs and add or replace the current entries with your unique settings.',

    'TAB.REGISTER' => 'Register',
    'TITLE.REGISTER' => 'Register',
    'REGISTER_TEXT' => 'Please register with us so we know a little about who is using Tiger. You can unsubscribe from our email updates at any time. You will also receive free email support with your registration as well. All registration fields are optional and not required to use TIGER.',

    'TAB.DATABASE' => 'Database',
    'TITLE.DATABASE' => 'Database',
    'DATABASE_TEXT' => 'For security reasons, we\'ll automagically setup a new database user and disable the default &quot;tiger&quot; database user.',

    'TAB.ENCRYPTION' => 'Encryption',
    'TITLE.ENCRYPTION' => 'Encryption',
    'ENCRYPTION_TEXT' => 'Again, for security reasons, we need to setup some unique encryption phrases. An encryption key is something secret, like a phrase or random string of characters. An Encryption IV (Initialization Vector) is also used to keep your encryption more random, like a SALT.',
    'LABEL.ENCRYPTION_KEY' => 'Encryption Key',
    'DESCRIPTION.ENCRYPTION_KEY' => 'Enter a phrase or string of random letters and numbers from 50 to 150 characters. The longer the better. Or you can click the generate button to generate a random string.',
    'LABEL.ENCRYPTION_IV' => 'Encryption IV',
    'DESCRIPTION.ENCRYPTION_IV' => 'Enter a phrase or string of random letters and numbers from 50 to 150 characters. The longer the better. Or you can click the generate button to generate a random string.',

    'TAB.ADMIN_USER' => 'Admin User',
    'TITLE.ADMIN_USER' => 'New Admin User',
    'ADMIN_USER_TEXT' => 'TIGER comes with a default username/password of &quot;tiger/tiger&quot;. Obviously, this needs to be changed, a new admin user setup, and the &quot;tiger&quot; user disabled. Enter the username and password for your new admin user.',
    'LABEL.ADMIN_FIRST_NAME' => 'Admin First Name',
    'DESCRIPTION.ADMIN_FIRST_NAME' => 'Please enter your administrator first name.',
    'LABEL.ADMIN_LAST_NAME' => 'Admin Last Name',
    'DESCRIPTION.ADMIN_LAST_NAME' => 'Please enter your administrator last or surname.',
    'LABEL.ADMIN_USERNAME' => 'Admin Username',
    'DESCRIPTION.ADMIN_USERNAME' => 'The admin username can be anything you like, any combination of letters and numbers with no spaces or special characters.',
    'LABEL.ADMIN_PASSWORD' => 'Admin Password',
    'LABEL.ADMIN_EMAIL' => 'Admin Email',
    'DESCRIPTION.ADMIN_EMAIL' => 'Enter your administrator email address. This needs to be a working email in the event you need to reset your password.',

    // SMTP Credentials //
    'TAB.SMTP' => 'SMTP',
    'TITLE.SMTP' => 'SMTP Credentials',
    'SMTP_TEXT' => 'Out of the box, TIGER uses an off-server SMTP service to send email. This is both for security and robustness. Enter the credentials for your fav SMTP service. If you don\'t know them or don\'t have them yet, you can enter them later via Server Config, or by editing the <b>/tiger-config/tiger-restricted.ini</b> file directly.',
    'LABEL.SMTP_HOST' => 'SMTP Host',
    'DESCRIPTION.SMTP_HOST' => 'Set your SMTP Host URL. For AWS SES US-East-1 region, it will be &quot;email-smtp.us-east-1.amazonaws.com&quot;.',
    'LABEL.SMTP_USERNAME' => 'SMTP Username',
    'DESCRIPTION.SMTP_USERNAME' => 'Set the SMTP Username for your SMTP provider. For AWS SES, this is usually the &quot;key&quot; or &quot;SMTP Username&quot; from a credentials.csv file.',
    'LABEL.SMTP_PASSWORD' => 'SMTP Password',
    'DESCRIPTION.SMTP_PASSWORD' => 'Set the SMTP Password for your SMTP provider. For AWS SES, this is usually the &quot;secret&quot; or &quot;SMTP Password&quot; from a credentials.csv file.',
    'LABEL.SMTP_AUTH' => 'SMTP Auth',
    'DESCRIPTION.SMTP_AUTH' => 'Set the auth mode for your SMTP provider. For AWS SES this is usually &quot;login&quot;.',
    'LABEL.SMTP_SSL' => 'SMTP SSL',
    'DESCRIPTION.SMTP_SSL' => 'Set the SSL protocol of your SMTP provider. For AWS SES this is usually &quot;tls&quot;.',
    'LABEL.SMTP_PORT' => 'SMTP Port',
    'DESCRIPTION.SMTP_PORT' => 'Set the port of your SMTP provider. For AWS SES this is usually &quot;587&quot;.',

    // Org DataTable Headers //
    'DT.ORGNAME' => 'Orgname',
    'DT.COMPANY_NAME' => 'Company Name',
    'DT.DISPLAY_NAME' => 'Display Name',
    'DT.ORG_DESCRIPTION' => 'Org Description',
    'DT.REFERRAL_CODE' => 'Referral Code',
    'DT.ORG_ID' => 'Org ID',
    'DT.PARENT_ORG_ID' => 'Parent Org ID',
    'DT.TYPE_ORG' => 'Type Org',
    'DT.DOMAIN' => 'Domain',

    // User DataTable Headers //
    'DT.USERNAME' => 'Username',
    'DT.USER_DISPLAY_NAME' => 'Display Name',
    'DT.EMAIL' => 'Email',
    'DT.FIRST_NAME' => 'First Name',
    'DT.MIDDLE_NAME' => 'Middle Name',
    'DT.LAST_NAME' => 'Last Name',
    'DT.ROLE' => 'Role',
    'DT.USER_ID' => 'User ID',

    // Signup Form //
    'SIGNUP.CREATE_ACCOUNT' => 'Create Account',
    'SIGNUP.VIEW_TERMS' => 'View Terms',
    'SIGNUP.HEADING' => 'Signup',
    'SIGNUP.INSTRUCTIONS' => 'Please give us some basic information to setup your account.',
    'FIRST_NAME' => 'First Name',
    'LAST_NAME' => 'Last Name',
    'COMPANY_NAME' => 'Company Name',
    'USERNAME' => 'Username',
    'EMAIL' => 'Email',
    'PASSWORD' => 'Password',
    'SELECT.PLEASE_SELECT' => 'Please Select',
    'LABEL.ACCEPT_TERMS' => 'Accept Terms of Service',
    'BUTTON.SIGNUP' => 'Signup',
    'REFERRAL_CODE' => 'Referral Code',
    'ERROR.NEW_USER_FAILED' => 'There was an error creating your account.',

    // Welcome Page - Shown after signup. //
    'HEADER.WELCOME' => 'Welcome!',
    'TITLE.WELCOME' => 'Welcome to Tiger!',
    'WELCOME.INSTRUCTIONS' => 'We\'ve sent an email to your email address. Please check your email and click on the verify link to verify your email address. If you do not receive an email, please check your &quot;spam folder&quot; or click the button bellow to resend the verification email.',
    'BUTTON.RESEND' => 'Resend Email',
    'SUCCESS.EMAIL_RESENT' => 'Email has been resent.',

    // Verify Account - Shown for Verify Email link. //
    'HEADER.VERIFY' => 'Verify Email',
    'SUCCESS.EMAIL_VERIFIED' => 'Email Verified!',
    'MESSAGE.VERIFY.SUCCESS_TEXT' => 'You email has been verified and you have been logged in. Click the button to visit your dashboard.',
    'BUTTON.VIEW_DASHBOARD' => 'View Dashboard',
    'ERROR.INVALID_KEY' => 'Invalid Activation Key',
    'MESSAGE.VERIFY.INVALID_TEXT_1' => 'The activation key supplied is invalid. Please contact our support team if you continue to experience issues activating your new account.',

    // Recover Password //
    'SUCCESS.EMAIL_SENT' => 'If your account exists, a password reset email has been sent.',

    // Login //
    'LOGIN.HEADING' => 'LOGIN',
    'LOGIN.FORGOT_PASSWORD' => 'Forgot Password?',
    'LOGIN.NEW_ACCOUNT' => 'New Account',
    'LOGIN.TIGER' => 'Tiger',
    'LOGIN.TEXT' => 'Welcome, please login.',
    'LABEL.REMEMBER_ME' => 'Remember Me',
    'BUTTON.LOGIN' => 'Login',
    'ALERT.LOGIN_FAILED' => '',

    // Lock //
    'LOCK.ACCOUNT_LOCKED' => 'Account Locked',
    'LOCK.SIGNIN_DIFFERENT_ACCOUNT' => 'Sign-in with a different account.',
    'LOCK.LOGIN' => 'Login',

    // Logout //
    'LOGOUT.LOGGED_OUT' => 'Logged Out',
    'LOGOUT.LOGIN' => 'Login',

    // Recover Password //
    'RECOVER.PASSWORD' => 'Recover Password',
    'RECOVER.LOGIN' => 'Login',
    'RECOVER.TIGER' => 'Tiger',
    'RECOVER.TEXT' => 'Please provide your account’s username or email and we will send you a link to reset your password.',
    'RECOVER.USERNAME_EMAIL' => 'Username or Email',
    'RECOVER.SEND_MAIL' => 'Send Mail',

    // Reset Password Modal //
    'FORM.RESET_PASSWORD' => 'Reset Password',
    'FORM.NEW_PASSWORD' => 'New Password',
    'FORM.SAVE_PASSWORD' => 'Save Password',
    'SUCCESS.PASSWORD_RESET' => 'New password saved.',

    // Email Templates //

    // Verify Email //
    'MAIL.VERIFY.SUBJECT' => 'Tiger: Verify Email Link',

    'MAIL.VERIFY.TEXT_LINE_1' => 'Welcome to TIGER!',
    'MAIL.VERIFY.TEXT_LINE_2' => 'Please verify your email.',
    'MAIL.VERIFY.TEXT_LINE_3' => 'Click on the link below to verify your email address.',
    // Link is inserted here. //
    'MAIL.VERIFY.TEXT_LINE_4' => 'WebTIGERS',
    'MAIL.VERIFY.TEXT_LINE_5' => 'Tiger Platform 2.0',

    // These translations are all located within the email template. //
    'VERIFY.WELCOME_TO' => 'Welcome to Tiger!',
    'VERIFY.ALT_IMAGE' => 'Alt Image',
    'VERIFY.WELCOME_HEADER' => 'Verify Email',
    'VERIFY.BODY_1' => 'Click the verify button below to verify your email and activate your account.',
    // Button link is inserted here. //
    'VERIFY.COMPANY_FOOTER' => 'WebTigers',
    'VERIFY.VERIFY' => 'Verify',
    'VERIFY.SITE_NAME' => 'Tiger Platform 2.0',

    // Recover Password //
    'MAIL.RECOVER.SUBJECT' => 'Tiger: Password Reset Request',
    'RECOVER.REST_PASSWORD' => 'Reset Password',
    'RECOVER.ALT_IMAGE' => 'Alt Image',
    'RECOVER.HEADER' => 'Reset Password',
    'RECOVER.BODY_1' => 'Click the reset password button below to login and update your password.',
    'RECOVER.BODY_2' => 'If you did not request a password reset, you can safely ignore and delete this email.',
    'RECOVER.RESET_PASSWORD' => 'Reset Password',
    // Button link is inserted here. //
    'RECOVER.COMPANY_FOOTER' => 'WebTigers',
    'RECOVER.VERIFY' => 'Recover',
    'RECOVER.SITE_NAME' => 'Tiger Platform 2.0',


    // Welcome Email //
    // Note this template has not yet been translated. //






];
