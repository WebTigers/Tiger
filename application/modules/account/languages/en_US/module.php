<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS / TIGER PLATFORM
 * Language Translation Keys
 * Account Module Templates and Messages
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [

    // Tiger Types //
    'TYPE.RETAIL' => 'Retail',
    'TYPE.SERVICE' => 'Service',
    'TYPE.WHOLESALE' => 'Wholesale',


    // Tiger Setup //
    'FORM.TIGER_SETUP' => 'Tiger Setup',
    'HEADER.SETUP_WELCOME' => 'Welcome!',
    'HEADER.SETUP_INITIAL' => 'Tiger Initial Setup',
    'HEADER.TERMS' => 'Terms of Service',
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

    // Email From Name //
    'MAIL.FROM_NAME' => 'Tiger Platform',

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
    'MAIL.VERIFY.TEXT_LINE_4' => 'WebTIGERS',
    'MAIL.VERIFY.TEXT_LINE_5' => 'Tiger Platform 2.0',

    // These translations are all located within the email template. //
    'VERIFY.HEADER' => 'Welcome to Tiger!',
    'VERIFY.ALT_IMAGE' => 'Alt Image',
    'VERIFY.SUBHEADING' => 'Verify Email',
    'VERIFY.BODY_1' => 'Click the verify button below to verify your email and activate your account.',
    'VERIFY.VERIFY' => 'Verify',
    'VERIFY.COMPANY_FOOTER' => 'WebTigers',
    'VERIFY.SITE_NAME' => 'Tiger Platform 2.0',

    // Recover Password //
    'MAIL.RECOVER.SUBJECT' => 'Tiger: Password Reset Request',
    'RECOVER.REST_PASSWORD' => 'Reset Password',
    'RECOVER.ALT_IMAGE' => 'Alt Image',
    'RECOVER.HEADER' => 'Reset Password',
    'RECOVER.BODY_1' => 'Click the reset password button below to login and update your password.',
    'RECOVER.BODY_2' => 'If you did not request a password reset, you can safely ignore and delete this email.',
    'RECOVER.RESET_PASSWORD' => 'Reset Password',
    'RECOVER.COMPANY_FOOTER' => 'WebTigers',
    'RECOVER.VERIFY' => 'Recover',
    'RECOVER.SITE_NAME' => 'Tiger Platform 2.0',

    // Welcome Email //
    'MAIL.WELCOME.SUBJECT' => 'Tiger: Welcome to Tiger!',
    'WELCOME.HEADING' => 'Welcome to Tiger!',
    'WELCOME.SUBHEADING' => 'Thanks for joining us!',
    'WELCOME.BODY_1' => 'Feel free to explore our product and get in touch if you have any questions, we will be more than happy to assist you.',
    'WELCOME.GET_STARTED' => 'Get Started',
    'WELCOME.COMPANY_FOOTER' => 'WebTigers',
    'WELCOME.SITE_NAME' => 'Tiger Platform 2.0',

    // Profile Form //
    'BUTTON.UPDATE' => 'Update',

    'TAB.USER_PROFILE' => 'User Profile',
    'TITLE.USER_PROFILE' => 'User Profile',
    'TEXT.USER_PROFILE' => 'Your account’s vital information. This information is editable by you.',
    'LABEL.USERNAME' => 'Username',
    'DESCRIPTION.USERNAME' => 'Please enter a username. Usernames may contain lowercase letters, numbers and a period.',
    'LABEL.USER_DISPLAY_NAME' => 'User Display Name',
    'DESCRIPTION.USER_DISPLAY_NAME' => 'A user display name is what you prefer to be seen as on the site and what other users will see your name as.',
    'LABEL.TYPE_TITLE' => 'Title',
    'DESCRIPTION.TYPE_TITLE' => 'Select an optional title.',
    'LABEL.TYPE_SUFFIX' => 'Name Suffix',
    'DESCRIPTION.TYPE_SUFFIX' => 'Select an optional name suffix.',
    'LABEL.COMPANY_TITLE' => 'Company Title',
    'DESCRIPTION.COMPANY_TITLE' => 'Add an optional company title.',
    'LABEL.AVATAR_URL' => 'Avatar URL',
    'DESCRIPTION.AVATAR_URL' => 'Choose a new avatar by entering a full ur relative URL to the image.',

    'TAB.PASSWORD' => 'Change Password',
    'TITLE.CHANGE_PASSWORD' => 'Change Password',
    'LABEL.CURRENT_PASSWORD' => 'Current Password',
    'LABEL.NEW_PASSWORD' => 'New Password',
    'DESCRIPTION.CURRENT_PASSWORD' => 'Please enter your current password to change passwords.',
    'TEXT.PASSWORD' => 'Changing your sign in password is an easy way to keep your account secure.',

    'FORM.MANAGE_AVATAR' => 'Manage Avatar',
    'AVATAR.SELECT_AVATAR' => 'Select Avatar',
    'AVATAR.TEXT_1' => 'Avatar Images can be uploaded here. Image files should be no larger 250 x 250 pixels. Drag an image into the uploader, the select the image to populate the url.',
    'TITLE.UPLOAD' => 'Upload',
    'AVATAR.DROP_FILES_HERE' => 'Drop an avatar image here to upload.',
    'BUTTON.REMOVE' => 'Remove',

    'MESSAGE.PROFILE_SAVED' => 'Profile Saved.',
    'MESSAGE.SAVE_FAILED' => 'Save Failed.',
    'MESSAGE.AVATAR_CHANGED' => 'Your avatar has changed. Be sure to save (update) your profile to keep these changes.',

    // Profile Address and Contacts //

    'MESSAGE.ADDRESS_SAVED' => 'Address Saved',
    'MESSAGE.ADDRESS_SAVE_FAILED' => 'There was an error saving your address.',

    'TAB.USER_ADDRESSES' => 'User Addresses',
    'TITLE.USER_ADDRESSES' => 'User Addresses',
    'TEXT.USER_ADDRESS' => 'Enter your user address information if you need to for mailing or billing purposes. Using the address selector, you can have multiple types of addresses.',

    'TAB.USER_CONTACTS' => 'User Contacts',
    'TITLE.USER_CONTACTS' => 'User Contacts',
    'TEXT.USER_CONTACTS' => 'Enter your contact information. Using the contact selector, you can have multiple types of contacts.',
    'TEXT.ORG_CONTACTS' => 'Enter your contact information. Using the contact selector, you can have multiple types of contacts.',
    'LABEL.ADD_NEW_CONTACT' => 'Add New Contact',
    'LABEL.TYPE_CONTACT' => 'Contact Type',
    'DESCRIPTION.TYPE_CONTACT' => 'Select the type of contact, whether phone, email, website, etc.',
    'LABEL.CONTACT_VALUE' => 'Contact Value',
    'DESCRIPTION.CONTACT_VALUE' => 'Enter the contact value. For a phone, enter your phone number. For an email, enter your email address. For a website, enter the URL of your website, etc.',
    'MESSAGE.CONTACT_SAVED' => 'Contact Saved.',
    'MESSAGE.CONTACT_REMOVED' => 'Contact has been removed.',
    'MESSAGE.CONTACT_REMOVE_FAILED' => 'Contact could not be removed.',

    // Profile Org //

    'MESSAGE.DEFAULT_ORG' => 'You are a member of the default org which is not editable from the profile screen.',
    'MESSAGE.NOT_ORG_ADMIN' => 'You must be an admin for your org to edit from the profile screen.',
    'TAB.ORG' => 'Company',
    'TITLE.ORG' => 'Company Information',
    'TEXT.ORG_PROFILE' => 'If you are part of an organization, you can enter that information here. Tiger offers this area only for applications with subscribers who may need to collect company information as well as user data. Some of these fields may be commented out in code if not needed for your particular application.',
    'LABEL.ORGNAME' => 'Orgname',
    'DESCRIPTION.ORGNAME' => 'Your organization\'s &quot;orgname&quot; is like a user\'s &quot;username&quot; within the application and must be unique among all the organizations within the application.',
    'LABEL.ORG_DISPLAY_NAME' => 'Organization Display Name',
    'DESCRIPTION.ORG_DISPLAY_NAME' => 'Like a user\'s display name, this is the name that typically gets shown for you and your user\'s benefit.',
    'LABEL.ORG_DESCRIPTION' => 'Organization Description',
    'DESCRIPTION.ORG_DESCRIPTION' => 'A short description of your organization that you would would like the public to see.',
    'LABEL.DOMAIN' => 'Domain or URL',
    'DESCRIPTION.DOMAIN' => 'Your organization\'s domain name or URL to your website.',
    'LABEL.TYPE_ORG' => 'Type of Organization',
    'DESCRIPTION.TYPE_ORG' => 'Please select the type of organization that best describes what your organization is.',
    'LABEL.TYPE_BUSINESS' => 'Type of Business',
    'DESCRIPTION.TYPE_BUSINESS' => 'If your organization is a business, please select the type of business that best describes what your company does.',
    'LABEL.REFERRAL_CODE' => 'Referral Code',
    'DESCRIPTION.REFERRAL_CODE' => 'You can create a short referral code that helps identify your organization when users signup. Users who signup with your referral code wil be assigned to your organization.',

    'TAB.ORG_ADDRESSES' => 'Company Addresses',
    'TITLE.ORG_ADDRESSES' => 'Company Addresses',
    'TEXT.ORG_ADDRESS' => 'Enter your company address information if you need to for mailing or billing purposes. Using the address selector, you can have multiple types of addresses.',

    'TAB.ORG_CONTACTS' => 'Company Contacts',
    'TITLE.ORG_CONTACTS' => 'Company Contacts',
    'LABEL.CONTACT_ID' => 'Contact',
    'DESCRIPTION.CONTACT_ID' => 'Select a contact to add, view or edit.',

    // Profile Address //

    'BUTTON.NEW' => 'New',
    'LABEL.ADDRESS_ID' => 'Select an Address',
    'LABEL.ADD_NEW_ADDRESS' => 'Add New Address',
    'DESCRIPTION.ADDRESS_ID' => 'Select an address to add, view or edit.',
    'TITLE.ADDRESS' => 'Address',
    'LABEL.TYPE_ADDRESS' => 'Type of Address',
    'DESCRIPTION.TYPE_ADDRESS' => 'Please tell us what type of address this is. Address tyupes are like: billing, home, or office.',
    'LABEL.PRIMARY' => 'Primary',
    'DESCRIPTION.PRIMARY' => 'Set your primary address or contact type. This will be the primary method we will use to contact you with.',
    'LABEL.ADDRESS' => 'Address',
    'DESCRIPTION.ADDRESS' => 'This is your primary street address, and usually includes your house or building number.',
    'LABEL.ADDRESS2' => 'Address 2',
    'DESCRIPTION.ADDRESS2' => 'This is your address\'s additional information, like an apartment, floor, or unit number.',
    'LABEL.CITY' => 'City',
    'DESCRIPTION.CITY' => 'The city or town your address is located.',
    'LABEL.STATE' => 'State',
    'DESCRIPTION.STATE' => 'The state where your address is located.',
    'LABEL.POSTAL_CODE' => 'Zip / Postal Code',
    'DESCRIPTION.POSTAL_CODE' => 'The zip or postal code for your address.',
    'LABEL.LAT' => 'Latitude',
    'DESCRIPTION.LAT' => '(Optional) This latitude for the address. If setup, this will be auto-configured for you.',
    'LABEL.LNG' => 'Longitude',
    'DESCRIPTION.LNG' => '(Optional) This longitude for the address. If setup, this will be auto-configured for you.',

];
