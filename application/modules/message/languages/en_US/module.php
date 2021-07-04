<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Module Language Translation Keys
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [

    'HEADING.MESSAGES' => 'Message Management',
    'MENU.ADMIN.MESSAGE' => 'Admin Messages',
    'MENU.MESSAGES' => 'Messages',
    'TITLE.MESSAGES' => 'Messages',

    'DT.TITLE' => 'Title',
    'DT.MESSAGE' => 'Message',
    'DT.TYPE_MESSAGE_STATUS' => 'Status',
    'DT.ROUTE' => 'Route',
    'DT.LOCALE' => 'Locale',
    'DT.START_DATE' => 'Start Date',
    'DT.END_DATE' => 'End Date',

    'TYPE.DRAFT' => 'Draft',
    'TYPE.PUBLISHED' => 'Published',
    'TYPE.RECALLED' => 'Recalled',
    'TYPE.EXPIRED' => 'Expired',

    'FORM.ADD_MESSAGE' => 'Add New Message',
    'FORM.EDIT_MESSAGE' => 'Edit Message',
    'TAB.MESSAGE' => 'Message',
    'TITLE.MESSAGE' => 'Message',
    'TAB.MESSAGE_DATES' => 'Dates',
    'TITLE.MESSAGE_DATES' => 'Dates',
    'TAB.MESSAGE_SEND_LIST' => 'Send List',
    'TITLE.MESSAGE_SEND_LIST' => 'Send List',
    'TITLE.MESSAGE_ALERT_ROUTES' => 'Alert Routes',

    'MESSAGE.TEXT' => 'Plain Text / HTML (No Wrapper)',
    'MESSAGE.SUCCESS' => 'Success',
    'MESSAGE.ALERT' => 'Alert',
    'MESSAGE.DANGER' => 'Danger',
    'MESSAGE.INFO' => 'Info',
    'MESSAGE.PRIMARY' => 'Primary',
    'MESSAGE.SECONDARY' => 'Secondary',
    'MESSAGE.LIGHT' => 'Light',
    'MESSAGE.DARK' => 'Dark',

    'MESSAGE.NOTIFICATIONS' => 'Message Module: Notifications',
    'MESSAGE.ALERTS' => 'Message Module: Alerts',

    'LABEL.MESSAGE_TITLE' => 'Message Title',
    'DESCRIPTION.MESSAGE_TITLE' => 'Enter a title for your message. This field is optional.',

    'LABEL.MESSAGE_MESSAGE' => 'Message',
    'DESCRIPTION.MESSAGE_MESSAGE' => 'Enter your message text. You can use HTML within your message.',
    'LABEL.MESSAGE_TYPE_STATUS' => 'Status',
    'DESCRIPTION.MESSAGE_TYPE_STATUS' => 'Select the message status type and click save to change the message status. Only messages set to &quot;Published&quot; will be seen. Note that inactive messages will also not be seen.',
    'LABEL.MESSAGE_TARGET' => 'Target',
    'DESCRIPTION.MESSAGE_TARGET' => 'Select the target module of this message. The target module is whatever module will be handling the publishing of the message.',
    'LABEL.MESSAGE_FORMAT' => 'Format',
    'DESCRIPTION.MESSAGE_FORMAT' => 'Select a message format to wrap your message inside of. When your message is published, it will be seen wrapped within one the selected standard Bootstrap alert types.',
    'LABEL.MESSAGE_ICON_CSS' => 'Select Icon',
    'DESCRIPTION.MESSAGE_ICON_CSS' => 'Select an icon. You can search for icons using the search bar when the selector appears. Icons are optional.',
    'LABEL.MESSAGE_DISMISSIBLE' => 'Dismissible Message',
    'DESCRIPTION.MESSAGE_DISMISSIBLE' => 'Sets an icon in the message so that the message can be dismissed if clicked.',

    'LABEL.MESSAGE_SEND_USERS' => 'Send Users',
    'DESCRIPTION.MESSAGE_SEND_USERS' => 'Search for individual users by usernname, email, or UserId.',
    'LABEL.MESSAGE_SEND_ROLES' => 'Send Roles',
    'DESCRIPTION.MESSAGE_SEND_ROLES' => 'Target users by their role.',
    'LABEL.MESSAGE_SEND_ORGS' => 'Send Orgs (Groups)',
    'DESCRIPTION.MESSAGE_SEND_ORGS' => 'Target groups of users by orgname or OrgId.',
    'LABEL.MESSAGE_SEND_LIST' => 'Send List',
    'DESCRIPTION.MESSAGE_SEND_LIST' => 'A JSON data object showing what users were selected for the message. This is for reference purposes only.',

    'LABEL.MESSAGE_START_DATE' => 'Start Date',
    'DESCRIPTION.MESSAGE_START_DATE' => 'Select a start date-time for this message. If no start date is selected, the message start date will be the create date-time.',
    'LABEL.MESSAGE_END_DATE' => 'End Date (Expires)',
    'DESCRIPTION.MESSAGE_END_DATE' => 'Select an end date-time for this message. If no end date is selected, the message will not expire.',

    'LABEL.MESSAGE_ROUTE' => 'Routes',
    'DESCRIPTION.MESSAGE_ROUTE' => 'Enter one or more routes this alert will display. List one route per line. Routes are: module, module/controller, or module/controller/action',

    'MESSAGE.TOTAL_USERS' => 'Total number of users selected: %s',
];
