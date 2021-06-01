<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Module Language Translation Keys
 * ————————————————————————————————————————————————————————————————————————————————
 */

return [

    // Common CMS Translations //
    'MENU.ADMIN.CMS' => 'Admin CMS',
    'MENU.ADMIN.CMS_DASHBOARD' => 'CMS Dashboard',

    'TITLE.CONTENT_PAGES' => 'Content Pages',
    'CMS_MODULE' => 'Content Management',

    'DT.TYPE' => 'Type',
    'DT.CATEGORY' => 'Category',
    'DT.UPDATE_DATE' => 'Update Date',

    'TITLE.DEFAULT_PAGE' => 'Set Default Page',

    'LABEL.USE_MVC_DEFAULT' => 'Use MVC Default',
    'LABEL.ROUTE_PAGE_ID' => 'Route or Page Key',
    'DESCRIPTION.ROUTE_PAGE_ID' => 'Select the page you would like to use as the default web page. MVC default will use the framework\'s views. Selecting a page key will serve that page as the default home page.',

    // Form Modal //

    'TITLE.PAGE' => 'Page',

    'FORM.ADD_PAGE' => 'Add Page',
    'FORM.EDIT_PAGE' => 'Edit Page',
    'FORM.SAVE_VERSION' => 'Save as Versioned',

    'TAB.CONTENT' => 'Content',
    'TAB.OPTIONS' => 'Options',
    'TAB.HEAD_LINKS' => 'Head Links',
    'TAB.HEAD_SCRIPTS' => 'Head Scripts',
    'TAB.INLINE_SCRIPTS' => 'Inline Scripts',
    'TAB.PAGE_CSS_JS' => 'Page CSS / JavaScript',
    'TAB.META' => 'Meta',

    'TAB.CODEVIEW' => 'Code View',
    'TAB.EDITVIEW' => 'Editor View',

    'LABEL.PAGE_NAME' => 'Page Name',
    'DESCRIPTION.PAGE_NAME' => 'The name of the webpage you are creating.',
    'LABEL.PAGE_KEY' => 'Page Key',
    'DESCRIPTION.PAGE_KEY' => 'The unique key (like a stub ID) that uniquely identifies this page within the database. The key can be any combination of letters, numbers and dash (-) characters.',
    'LABEL.THEME' => 'Theme',
    'DESCRIPTION.THEME' => 'Select the theme to use for this page.',
    'LABEL.LAYOUT' => 'Layout',
    'DESCRIPTION.LAYOUT' => 'Select the layout to use for this page. You can only select this once the theme has been selected.',
    'LABEL.LOCALE' => 'Locale',
    'DESCRIPTION.LOCALE' => 'The locale of the page.',
    'LABEL.PAGE_TYPE' => 'Content Type',
    'DESCRIPTION.PAGE_TYPE' => 'Select the type of content this page will be.',
    'LABEL.CATEGORY' => 'Category',
    'DESCRIPTION.CATEGORY' => 'Enter a category for this page or content, if any.',
    'LABEL.TEMPLATES' => 'Theme Templates',
    'DESCRIPTION.TEMPLATES' => 'If a theme has different templates, you can select from among the preloaded templates here. Click the insert button next to the selector to insert the selected template HTML code into the editor.',

    'OPTION.SELECT_LAYOUT' => 'Select Layout',
    'OPTION.PARTIAL' => 'Partial',
    'OPTION.PAGE' => 'Page',
    'OPTION.BLOG' => 'Blog',
    'OPTION.MENU' => 'Menu',
    'OPTION.LAYOUT' => 'Layout',
    'OPTION.DOC' => 'Doc',
    'OPTION.SELECT_THEME' => 'Select Theme',
    'OPTION.SELECT_TEMPLATE' => 'Select Template',
    'OPTION.SELECT_SCHEME' => 'Select Scheme',

    'LABEL.DEFAULT_LAYOUT' => 'Default Layout',
    'LABEL.BLANK_LAYOUT' => 'Blank Layout',
    'LABEL.DEFAULT_BLOG' => 'Blog Layout',
    'LABEL.FULL_WIDTH' => 'Full Width',
    'LABEL.ARTICLE' => 'Article',

    'TITLE.OPTIONS' => 'Options',
    'LABEL.PAGE_TITLE' => 'Page Title',
    'DESCRIPTION.PAGE_TITLE' => 'Enter a page title for this page.',
    'LABEL.PAGE_SCHEME' => 'Scheme',
    'DESCRIPTION.PAGE_SCHEME' => 'Select a scheme for this page, if any are available. Schemes are typically like color variations, or light, dark, etc.',

    // Head Links //

    'TITLE.HEAD_LINKS' => 'Head Links',
    'INFO.CREATE_LINK' => 'Add new Head Link',
    'LABEL.LINK_ATTR' => 'Link Attribute',
    'DESCRIPTION.LINK_ATTR' => 'Select a link attribute for this head link.',
    'LABEL.LINK_VALUE' => 'Link Value',
    'DESCRIPTION.LINK_VALUE' => 'Enter the value for this link attribute.',

    // Head Scripts //

    'TITLE.HEAD_SCRIPTS' => 'Head Scripts',
    'INFO.CREATE_SCRIPT' => 'Add new Head Script',
    'LABEL.SCRIPT_ATTR' => 'Script Attribute',
    'DESCRIPTION.SCRIPT_ATTR' => 'Select a script attribute.',
    'LABEL.SCRIPT_VALUE' => 'Script Attribute Value',
    'DESCRIPTION.SCRIPT_VALUE' => 'Enter the value for this script attribute.',

    // Inline Scripts //

    'TITLE.INLINE_SCRIPTS' => 'Inline Scripts',

    // Scripts / CSS //

    'TITLE.SCRIPTS' => 'Scripts / CSS',
    'LABEL.STYLES' => 'CSS Styles',
    'DESCRIPTION.STYLES' => 'Add any head CSS styles here. These will appear between <style> tags in the head section of the page.',
    'LABEL.SCRIPTS' => 'Head Scripts',
    'DESCRIPTION.SCRIPTS' => 'Add any head JavaScript here. This code will appear between <script> tags in the head section of the page.',

    // Meta //

    'TITLE.META_CHARSET' => 'Charset',
    'LABEL.META_CHARSET' => 'Charset',
    'DESCRIPTION.META_CHARSET' => 'Enter the charset (character set) for this page. This is typically "utf-8".',

    'TITLE.META_NAME' => 'Name',
    'LABEL.META_VIEWPORT' => 'Viewport',
    'DESCRIPTION.META_VIEWPORT' => 'Enter any viewport data here.',
    'LABEL.META_DESCRIPTION' => 'Page Description',
    'DESCRIPTION.META_DESCRIPTION' => 'Enter a page description of the content.',
    'LABEL.META_AUTHOR' => 'Author',
    'DESCRIPTION.META_AUTHOR' => 'Enter a page author name here.',
    'LABEL.META_KEYWORDS' => 'Keywords',
    'DESCRIPTION.META_KEYWORDS' => 'Enter any SEO keywords here.',
    'LABEL.META_ROBOTS' => 'Robots',
    'DESCRIPTION.META_ROBOTS' => 'Enter any search robots info here.',

    // Meta Opengraph (Social) //

    'TITLE.META_OPENGRAPH' => 'OpenGraph (Social Media)',
    'LABEL.META_OG-TYPE' => 'Type',
    'DESCRIPTION.META_OG-TYPE' => 'Enter the type of content, like "website", etc.',
    'LABEL.META_OG-TITLE' => 'Title',
    'DESCRIPTION.META_OG-TITLE' => 'Enter the title for this page.',
    'LABEL.META_OG-DESCRIPTION' => 'Description',
    'DESCRIPTION.META_OG-DESCRIPTION' => 'Enter a description for this page.',
    'LABEL.META_OG-URL' => 'URL',
    'DESCRIPTION.META_OG-URL' => 'Enter the full URL for this page.',
    'LABEL.META_OG-LOCALE' => 'Locale',
    'DESCRIPTION.META_OG-LOCALE' => 'Enter the locale for this page.',

    'LABEL.META_OG-IMAGE' => 'Image URL',
    'DESCRIPTION.META_OG-IMAGE' => 'Enter the full Image URL for this page.',
    'LABEL.META_OG-IMAGE-SECURE_URL' => 'Image Secure URL',
    'DESCRIPTION.META_OG-IMAGE-SECURE_URL' => 'Enter the full secure URL for this page.',
    'LABEL.META_OG-IMAGE-WIDTH' => 'Image Width',
    'DESCRIPTION.META_OG-IMAGE-WIDTH' => 'Enter the image width for this page.',
    'LABEL.META_OG-IMAGE-HEIGHT' => 'Image Height',
    'DESCRIPTION.META_OG-IMAGE-HEIGHT' => 'Enter the image height for this page.',
    'LABEL.META_OG-IMAGE-TYPE' => 'Image Type',
    'DESCRIPTION.META_OG-IMAGE-TYPE' => 'Enter the image mime type for this page.',
    'LABEL.META_OG-IMAGE-ALT' => 'Image Alt',
    'DESCRIPTION.META_OG-IMAGE-ALT' => 'Enter the image alt text for this page.',

    'LABEL.META_OG-VIDEO' => 'Video',
    'DESCRIPTION.META_OG-VIDEO' => 'Enter the full video URL for this page. This is the same as Video URL. Use either or.',
    'LABEL.META_OG-VIDEO-URL' => 'Video URL',
    'DESCRIPTION.META_OG-VIDEO-URL' => 'Enter the full video URL for this page. This is the same as Video. Use either or.',
    'LABEL.META_OG-VIDEO-SECURE_URL' => 'Secure Video URL',
    'DESCRIPTION.META_OG-VIDEO-SECURE_URL' => 'Enter the full secure video URL for this page.',
    'LABEL.META_OG-VIDEO-WIDTH' => 'Video Width',
    'DESCRIPTION.META_OG-VIDEO-WIDTH' => 'Enter the video width for this page.',
    'LABEL.META_OG-VIDEO-HEIGHT' => 'Video Height',
    'DESCRIPTION.META_OG-VIDEO-HEIGHT' => 'Enter the video height for this page.',
    'LABEL.META_OG-VIDEO-TYPE' => 'Video Type',
    'DESCRIPTION.META_OG-VIDEO-TYPE' => 'Enter the video mime type for this page.',



];
