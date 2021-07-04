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

/**
 * jQuery Tiger CMS Admin Plugin
 */

CKEDITOR_BASEPATH = '/assets/oneui/js/plugins/ckeditor/';

(function( $ ){

    let Class = {

        pageDT : null,
        editor : null,
        ckeditor : null,
        content : null,
        theme : null,
        themes : null,
        templates : [],
        themesSelect : [],
        themeOptionsForm : [],
        themeMetaForm : [],
        themeLinksForm : [],
        themeHeadScriptsForm : [],
        themeInlineScriptsForm : [],
        themeContent : null,

        init : function( ) {

            $(document).ready(function() {

                // Page init stuff goes here. //
                Class._initPageDataTable();
                Class._initThemeData();
                Class._initControls();

            });

        },

        // Admin Functions //

        _initThemeData : function () {

            /** When the page loads, we want to know all of the themes available and installed. */

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                     Class.themes = data.data;

                     $.each( Class.themes, function( theme, data ) {
                         Class.themesSelect.push({
                             id: theme,
                             text: ( theme ) ? theme.toUpperCase() : data
                         });
                     });

                     Class._initThemeSelect2();

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'cms:admin',
                method  : 'getThemes',
            };

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                success     : success,
                error       : error
            });

        },

        _clearThemeForms : function () {

            $('#page-form #page_id').val('');
            $('#options-container').children().remove();
            $('#meta-charset-container').children().remove();
            $('#meta-name-container').children().remove();
            $('#meta-opengraph-container').children().remove();
            $('#head-links-container').children().remove();
            $('#head-scripts-container').children().remove();
            $('#inline-scripts-container').children().remove();

        },

        _getThemeForms : function () {

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( parseInt(data.result, 10) === 1 ) {

                    Class.templates                 = data.data.templates;
                    Class.themeOptionsForm          = data.data.options;
                    Class.themeMetaForm             = data.data.meta;
                    Class.themeLinksForm            = data.data.links;
                    Class.themeHeadScriptsForm      = data.data.headScripts;
                    Class.themeInlineScriptsForm    = data.data.inlineScripts;

                    Class._buildOptions();
                    Class._buildMeta();
                    Class._buildLinks();
                    Class._buildScripts( 'Head' );
                    Class._buildScripts('Inline' );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'cms:admin',
                method  : 'getThemeFormFields',
                theme   : Class.theme
            };

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                success     : success,
                error       : error
            });

        },

        _buildOptions : function () {

            let $control = '', $container = $('#options-container');

            /** Make sure we clear the container before rebuilding it. */
            $container.children().remove();

            $( Class.themeOptionsForm ).each( function ( i, el ) {
                $control = $().cmsOneUITemplate('options', el );
                $container.append( $control );
            });

            // Init Tooltips //
            One.helpers('core-bootstrap-tooltip');

            // Init Select2 Controls //
            Class._initSchemeSelect2();

        },

        _buildMeta : function () {

            let $control = '', $container = '';

            /** Make sure we clear the container before rebuilding it. */
            $('#meta-charset-container').children().remove();
            $('#meta-name-container').children().remove();
            $('#meta-opengraph-container').children().remove();

            $.each( Class.themeMetaForm, function ( attr, meta ) {

                $control = $().cmsOneUITemplate('meta', meta);
                /** Try to organize things a bit in the UI. */
                $container = $('#meta-' + meta.meta + '-container');
                $container.append( $control );

            });

            // Init Tooltips //
            One.helpers('core-bootstrap-tooltip');

        },

        _buildLinks : function () {

            let $control = '',
                $linksContainer = $('#head-links-container'),
                linkName = '',
                containerHeader = '',
                $linkNameContainer = '',
                $linkRowContainer = '',
                $linkAttributeRow = '';

            /** Make sure we clear the container before rebuilding it. */
            $('#head-links-container').children().remove();

            function createRow( link ){
                $linkAttributeRow = $('<div class="row"></div>')
                $control = $().cmsOneUITemplate('links', link);
                $linkAttributeRow.append( $control );
                $linkRowContainer.append( $linkAttributeRow );
                $linksContainer.append( $linkNameContainer );
                return $control;
            }

            $.each( Class.themeLinksForm, function ( i, link ) {

                if ( linkName === link.link ) {

                    /** Create next link attribute. */

                    $control = createRow( link );
                    /** Remove labels and info icons from all but the first attribute to save space ... */
                    $control.find('label, i').not('.button-icon').remove();

                }
                else {

                    /** Create new link section with first attribute. */

                    linkName = link.link;

                    if ( i > 0 ) {
                        /** A little confusing, but these get appended to the previous container. */
                        $linkNameContainer.append( $('<pre class="example"></pre>') );
                        $linksContainer.append( $('<hr>') );
                    }

                    $linkNameContainer = $('<div id="' + linkName + '" class="linkname-container"></div>');
                    containerHeader =
                        '<h4><span class="link-id">' + linkName + '</span>' +
                            '<span id="create-attribute-'+ linkName +'" class="create-attribute">' +
                                '<i class="si si-plus" title="Add new attribute" data-toggle="tooltip" data-placement="left" data-animation="true"></i>' +
                            '</span>' +
                        '</h4>';
                    $linkNameContainer.append( $( containerHeader ) );
                    $linkRowContainer = $('<div class="linkrow-container"></div>')
                    $linkNameContainer.append( $linkRowContainer );
                    createRow( link );
                }

            });

            if ( $linkNameContainer ) {

                /** Append the preview link to the last linkNameContainer. */
                $linkNameContainer.append($('<pre class="example"></pre>'));

                /** Now build all of the visual links. */
                $('.linkrow-container').each(function () {
                    Class._buildExampleLink(this);
                });

            }

            /** Init Tooltips */
            One.helpers('core-bootstrap-tooltip');

            /** Init Select2 Controls */
            $linksContainer.find('select').select2({
                minimumResultsForSearch : -1,
                width : '100%'
            });

            $('.linkname-container').children().first().find('input').trigger('keyup');

        },

        _buildExampleLink : function ( linkRowContainer ) {

            let html = '<link';
            $( linkRowContainer ).children('div.row').each(function (i, div){
                html += ' ' + $(div).find('select').val();
                if ( $(div).find('select').val() !== '' ) {
                    html += '="' + $(div).find('input').val() + '"';
                }
            });
            html += '>';

            $( linkRowContainer ).parent().find('pre').html( Class._htmlEncode( html ) );

        },

        _buildScripts : function ( container ) {

            let $control = '',
                $scriptsContainer = $('#'+container.toLowerCase()+'-scripts-container'),
                scriptName = '',
                containerHeader = '',
                $scriptNameContainer = '',
                $scriptRowContainer = '',
                $scriptAttributeRow = '';

            /** Make sure we clear the container before rebuilding it. */
            $scriptsContainer.children().remove();

            function createRow( script ){
                $scriptAttributeRow = $('<div class="row"></div>')
                $control = $().cmsOneUITemplate('scripts', script);
                $scriptAttributeRow.append( $control );
                $scriptRowContainer.append( $scriptAttributeRow );
                $scriptsContainer.append( $scriptNameContainer );
                return $control;
            }

            $.each( Class['theme'+container+'ScriptsForm'], function ( i, script ) {

                if ( scriptName === script.script ) {

                    /** Create next script attribute. */

                    $control = createRow( script );
                    /** Remove labels and info icons from all but the first attribute to save space ... */
                    $control.find('label, i').not('.button-icon').remove();

                }
                else {

                    /** Create new script section with first attribute. */

                    scriptName = script.script;

                    if ( i > 0 ) {
                        /** A little confusing, but these get appended to the previous container. */
                        $scriptNameContainer.append( $('<pre class="example"></pre>') );
                        $scriptsContainer.append( $('<hr>') );
                    }

                    $scriptNameContainer = $('<div id="' + scriptName + '" class="scriptname-container"></div>');
                    containerHeader =
                        '<h4><span class="script-id">' + scriptName + '</span>' +
                        '<span id="create-attribute-'+ scriptName +'" class="create-attribute">' +
                        '<i class="si si-plus" title="Add new attribute" data-toggle="tooltip" data-placement="left" data-animation="true"></i>' +
                        '</span>' +
                        '</h4>';
                    $scriptNameContainer.append( $( containerHeader ) );
                    $scriptRowContainer = $('<div class="scriptrow-container"></div>')
                    $scriptNameContainer.append( $scriptRowContainer );
                    createRow( script );
                }

            });

            if ( $scriptNameContainer ) {

                /** Append the preview script to the last scriptNameContainer. */
                $scriptNameContainer.append($('<pre class="example"></pre>'));

                /** Now build all of the visual scripts. */
                $scriptsContainer.find('.scriptrow-container').each(function () {
                    Class._buildExampleScript(this);
                });

            }

            /** Init Tooltips */
            One.helpers('core-bootstrap-tooltip');

            /** Init Select2 Controls */
            $scriptsContainer.find('select').select2({
                minimumResultsForSearch : -1,
                width : '100%'
            });

            $('.scriptname-container').children().first().find('input').trigger('keyup');

        },

        _buildExampleScript : function ( event ) {

            let $scriptRowContainer = $(this).closest('.scriptrow-container');

            let html = '<script';
            $scriptRowContainer.children('div.row').each(function (i, div){
                html += ' ' + $(div).find('select').val();
                if ( $(div).find('select').val() !== '' ) {
                    html += '="' + $(div).find('input').val() + '"';
                }
            });
            html += '></script>';

            $scriptRowContainer.parent().find('pre').html( Class._htmlEncode( html ) );

        },
        
        _htmlEncode : function ( html ) {

            /** A handy function copied from StackOverflow to render HTML in the DOM. */

            html = $.trim(html);
            return html.replace(/[&"'\<\>]/g, function(c){
                switch (c) {
                    case "&":
                        return "&amp;";
                    case "'":
                        return "&#39;";
                    case '"':
                        return "&quot;";
                    case "<":
                        return "&lt;";
                    default:
                        return "&gt;";
                    }
                }
            );
        },

        _initPageDataTable : function () {

            let $datatable = $('#pagesDT');
            let $block = $datatable.closest('div.block');
            One.block('state_loading', $block );

            Class.pageDT = $datatable.DataTable({
                'searching': true,
                'processing': false,
                'serverSide': true,
                'orderMulti': true,
                'order': [[5, 'desc']],
                'class': 'hover',
                'autoWidth': false,
                'lengthMenu': [ 5, 10, 25, 50, 100 ],
                'language': {
                    "url": "/assets/translate/js/DataTables/i18n/" + LOCALE + ".json"
                },
                'initComplete': function (settings, json) {

                    // Class.pages = json.data;

                    $(Class.pageDT.column(0).header()).text( json.i18n['DT.NAME'] );
                    $(Class.pageDT.column(1).header()).text( json.i18n['DT.KEY'] );
                    $(Class.pageDT.column(2).header()).text( json.i18n['DT.TYPE'] );
                    $(Class.pageDT.column(3).header()).text( json.i18n['DT.CATEGORY'] );
                    $(Class.pageDT.column(4).header()).text( json.i18n['DT.LOCALE'] );
                    $(Class.pageDT.column(5).header()).text( json.i18n['DT.UPDATE_DATE'] );
                    $(Class.pageDT.column(6).header()).text( json.i18n['DT.ACTIONS'] );
                    $(Class.pageDT.column(7).header()).text( json.i18n['DT.PAGE_ID'] );
                    $(Class.pageDT.column(8).header()).text( json.i18n['DT.ACTIVE'] );
                    $(Class.pageDT.column(9).header()).text( json.i18n['DT.DELETED'] );

                    setTimeout( function () {
                        One.block('state_normal', $block);
                    }, 1000);

                },
                'ajax': {
                    'url': '/api',
                    'type': 'POST',
                    'dataType': 'json',
                    'dataSrc': 'data',
                    'data': {
                        service: 'cms:admin',
                        method: 'getAdminPagesDataTable'
                    }
                },
                'columns': [{
                    'title': 'DT.NAME',
                    'name': 'name',
                    'data': 'name'
                }, {
                    'title': 'DT.KEY',
                    'name': 'key',
                    'data': 'key'
                }, {
                    'title': 'DT.TYPE',
                    'name': 'type',
                    'data': 'type'
                }, {
                    'title': 'DT.CATEGORY',
                    'name': 'category',
                    'data': 'category'
                }, {
                    'title': 'DT.LOCALE',
                    'name': 'locale',
                    'data': 'locale'
                }, {
                    'title': 'DT.UPDATE_DATE',
                    'name': 'update_date',
                    'data': 'update_date'
                }, {
                    'title': 'DT.ACTIONS',
                    'targets': -1,
                    'data': null,
                    'orderable': false,
                    'width': '150px',
                    'render': Class._buildControls,
                }, {
                    'title': 'DT.PAGE_ID',
                    'name': 'page_id',
                    'data': 'page_id',
                    'visible': false
                }, {
                    'title': 'DT.ACTIVE',
                    'name': 'active',
                    'data': 'active',
                    'class': 'active',
                    'visible': false
                }, {
                    'title': 'DT.DELETED',
                    'name': 'deleted',
                    'data': 'deleted',
                    'class': 'deleted',
                    'visible': false
                }]
            });

            Class.pageDT.on('draw', function ( event, settings ) {

                // Class.pages = settings.json.data;
                // Class._initRouteSelect2(true);

                One.helpers('core-bootstrap-tooltip');

            });

        },

        _buildControls : function ( data, type, row, meta ) {

            let html = '';

            $( data.controls ).each(function (i, el) {

                if ( el.type === 'icon' ) {
                    html += $('<i>')
                        .attr('data-id', el.id)
                        .attr('data-value', el.value)
                        .attr('class', el.class)
                        .attr('title', el.title)
                        .attr('data-toggle', 'tooltip')
                        .attr('data-animation', 'true')
                        .attr('data-placement', 'bottom')
                        .attr('data-delay', '{ "show": 2000, "hide": 100 }')
                        .prop('outerHTML');
                }

                if ( el.type === 'button' ) {
                    html += $('<button>')
                        .attr('data-id', el.id)
                        .attr('data-value', el.value)
                        .attr('class', el.class)
                        .attr('title', el.title)
                        .prop('outerHTML');
                }

            });

            return html;

        },

        _initControls : function () {

            $('#add-page').on( 'click', Class._add );
            $('#save-button').on( 'click', Class._save );
            $('#insert-text').on('click', Class._insert );

            Class._initTypeSelect2();
            Class._initLocaleSelect2();
            Class._initRouteSelect2();

            $('#create-link').on( 'click', Class._createLink );
            $('#create-head-script').on( 'click', Class._createScript );
            $('#create-inline-script').on( 'click', Class._createScript );

            $('body').on('click', 'table i.edit', Class._edit );
            $('body').on('click', 'table i.active, table i.deleted', Class._update );

            $('body').on('click', 'button.remove-link', Class._removeLink );
            $('body').on('click', 'button.remove-script', Class._removeScript );

            $('body').on('click', 'span.create-link-attribute', Class._createLinkRow );
            $('body').on('click', 'span.create-script-attribute', Class._createScriptRow );

            $('body').on('change', '.btabs-animated-fade-page-links select', function (){
                Class._buildExampleLink( $(this).closest('.linkrow-container') );
            });
            $('body').on('change', '.btabs-animated-fade-page-scripts select', function (){
                Class._buildExampleScript( $(this).closest('.scriptrow-container') );
            });

            $('body').on('keyup', 'input', function (){
                Class._buildExampleLink( $(this).closest('.linkrow-container') );
            });

            $('body').on('keyup', 'div.linkrow-container div.row:first-child input', Class._updateLinkId );
            $('body').on('keyup', 'div.scriptrow-container div.row:first-child input', Class._updateScriptId );

            $().tigerDOM('initToggleControls');

            $('#cms-tabs-editors a.nav-link').on('show.bs.tab', function( event ){
                Class._updateContent( $(event.target).attr('id') );
            });

        },

        // Select2 Functions //

        _initThemeSelect2 ( ) {

            $('#page-form #theme').select2({
                data : Class.themesSelect,
                minimumResultsForSearch : -1,
                width : '100%',
                placeholder: {
                    id : Class.themesSelect[0].id,
                    text : Class.themesSelect[0].text
                }
            })
            .on( 'change', Class._setPageFormTheme );

        },

        _initLayoutSelect2 ( ) {

            if ( $('#page-form #layout').hasClass("select2-hidden-accessible") ) {
                $('#page-form #layout').select2('destroy').find('option').remove();
            }

            $('#page-form #layout').select2({
                data : Class.themes[Class.theme].layouts,
                minimumResultsForSearch : -1,
                width : '100%',
                placeholder: {
                    id : Class.themes[Class.theme].layouts[0].id,
                    text : Class.themes[Class.theme].layouts[0].text
                }
            });

        },

        _initSchemeSelect2 ( ) {

            $('#page-form #scheme').select2({
                // data : Class.themes[Class.theme].schemes,
                data : [],
                minimumResultsForSearch : -1,
                width : '100%',
                placeholder: {
                    // id : Class.themes[Class.theme].schemes[0].id,
                    // text : Class.themes[Class.theme].schemes[0].text
                }
            });

        },

        _initTemplateSelect2 ( ) {

            /** The template shows all of a theme's templates that can be inserted into a page. */

            if ( $('#page-form #templates').hasClass("select2-hidden-accessible") ) {
                $('#page-form #templates').select2('destroy').find('option').remove();
            }

            $('#page-form #templates').select2({
                // minimumResultsForSearch : -1,
                width : '100%',
                data : Class.themes[Class.theme].templates,
                placeholder: {
                    id : Class.themes[Class.theme].templates[0].id,
                    text : Class.themes[Class.theme].templates[0].text
                },
                templateResult : function formatState ( template ) {

                    if ( ! template.id) { return template.text; }

                    return $(
                        '<div class="clearfix">' +
                            '<span>'+ template.text + '</span>' +
                            '<img src="' + template.image + '" class="select-template" />' +
                        '</div>'
                    );
                }
            }).on('select2:select', Class._getTemplateContent );

        },

        _initTypeSelect2 ( ) {

            $('#page-form #type').select2({
                minimumResultsForSearch : -1,
                width : '100%',
            });

        },

        _initLocaleSelect2 ( ) {

            $('#page-form #locale').select2({
                minimumResultsForSearch : -1,
                width : '100%',
            });

        },

        _setPageFormTheme : function ( event ) {

            /** If the theme changes, update our other controls with that theme's options. */

            Class.theme = $(this).val();

            Class._initLayoutSelect2();
            Class._initSchemeSelect2();
            Class._initTemplateSelect2();

            Class._getThemeForms();

        },

        _initRouteSelect2 ( ) {

            function data( params ) {

                let query = {
                    search  : params.term,
                    page    : params.page || 0,
                    limit   : 10,
                    order   : 'priority ASC',
                    service : 'cms:admin',
                    method  : 'getPageSelect2List'
                }

                return query;

            }

            $('#route-form #route_page_id').select2({
                width : '100%',
                ajax: {
                    type        : "POST",
                    url         : "/api",
                    dataType    : "json",
                    data        : data
                }
            }).on('select2:select', Class._homePage );

        },

        // TAB Editors //

        _createCKEditor : function ( html ) {

            if ( Class.ckeditor ) { return; }

            $('#ck-content').val( html );

            let config = {
                allowedContent: true,
                protectedSource: /<\?[\s\S]*?\?>/g,
                extraPlugins: 'codemirror,colorbutton,colordialog',
                basicEntities: true,
                height: 400
            };

            Class.ckeditor = CKEDITOR.replace('ck-content', config);

        },

        _removeCKEditor :  function () {

            if ( ! Class.ckeditor ) { return; }

            let html = Class.ckeditor.getData();

            $('#ck-content').val( html );

            Class.ckeditor.destroy();
            Class.ckeditor = null;

        },

        _createAceEditor : function ( content ) {

            Class.editor = ace.edit("ace-content");
            Class.editor.setTheme("ace/theme/tomorrow_night");
            Class.editor.session.setMode("ace/mode/php");
            Class.editor.setOptions({
                maxLines: 50
            });
            Class.editor.setValue( content );
            Class.editor.navigateTo(0,1);

        },

        _resizeAceEditor : function () {

            Class.editor.on('change', function(e) {
                let lineHeight = ( Class.editor.renderer.lineHeight > 0 ) ? Class.editor.renderer.lineHeight : 10;
                let doc = Class.editor.getSession().getDocument();
                let height = lineHeight * doc.getLength() + 'px';
                $("#ace-content").css('height', height );
                Class.editor.resize();
            });

        },

        _updateContent( id ) {

            if ( id === 'codeview' ) {

                Class.content = CKEDITOR.instances['ck-content'].getData();
                Class.editor.setValue( Class.content );

            }
            else {

                Class.content = Class.editor.getValue();
                Class._removeCKEditor();
                Class._createCKEditor( Class.content );

            }

        },

        _setContent (  ) {

            if ( $('#btabs-animated-fade-editview').hasClass('show') ) {
                Class.content = CKEDITOR.instances['ck-content'].getData();
            }
            else {
                Class.content = Class.editor.getValue();
            }

        },

        // TAB Meta, includes SEO and OpenGraph //

        _createMeta : function () {

        },

        _removeMeta : function () {

        },

        // TAB Links, includes Favicons, //

        _removeLink : function ( event ) {

            let $linkNameContainer = $(this).closest('div.linkname-container'),
                $linkRowContainer = $(this).closest('div.linkrow-container');

            if ( $linkRowContainer.children('div').length === 1 ) {
                $linkNameContainer.next('hr').tigerDOM('remove');
                $linkNameContainer.tigerDOM('remove', function( ) {
                    $('#head-links-container').css('height','auto');
                });
            }
            else {
                $(this).closest('div.row').tigerDOM('remove', function (){
                    // $linksRowContainer.css('height','auto');
                    Class._buildExampleLink( $linkRowContainer );
                });

            }

        },

        _createLinkRow : function ( event ) {

            let $control = '',
                $linkRowContainer = $(this).closest('.linkname-container').find('.linkrow-container'),
                $linkAttributeRow = '',
                link = {
                    name: "change-me",
                    id: "change-me",
                    value: "change-me",
                    labelAttr: "LABEL.LINK_ATTR",
                    descriptionAttr: "DESCRIPTION.LINK_ATTR",
                    labelValue: "LABEL.LINK_VALUE",
                    descriptionValue: "DESCRIPTION.LINK_VALUE"
                };

            $linkAttributeRow = $('<div class="row"></div>');
            $control = $().cmsOneUITemplate('links', link);
            /** Remove labels and info icons from all but the first attribute to save space ... */
            if ( $linkRowContainer.children().length > 0 ) {
                $control.find('label, i').not('.button-icon').remove();
            }
            $linkAttributeRow.append( $control );
            $linkRowContainer.tigerDOM('insert', {
                content: $linkAttributeRow,
                callback : function (){
                    $linkAttributeRow.find('#select-change-me').select2({
                        minimumResultsForSearch : -1,
                        width : '100%',
                    })
                    .on( 'change', Class._buildExampleLink );

                    if ( $linkRowContainer.children().length === 1 ) {
                        $linkAttributeRow.find('#select-change-me').val('id').trigger('change');
                    }
                    else {
                        $linkAttributeRow.find('#select-change-me').val(null).trigger('change');
                    }
                }
            });

            Class._buildExampleLink( $linkRowContainer );

        },

        _createLink : function ( event ) {

            let $content = '',
                $linksContainer = $( $(this).data('target') ),
                linkName = '',
                containerHeader = '',
                $linkNameContainer = '';

            $content =
                '<div id="change-me" class="linkname-container">\n' +
                '    <h4><span class="link-id">change-me</span>\n' +
                '        <span id="change-me" class="create-link-attribute">\n' +
                '            <i class="si si-plus js-tooltip-enabled" title="Add new attribute" data-toggle="tooltip" data-placement="left" data-animation="true"></i>\n' +
                '        </span>\n' +
                '    </h4>\n' +
                '    <div class="linkrow-container"></div>\n' +
                '    <pre class="example"></pre>\n' +
                '</div>\n' +
                '<hr>\n';

            $linksContainer.prepend( $content ).children('div').first().find('span.create-link-attribute').click();

            /** Init Tooltips */
            One.helpers('core-bootstrap-tooltip');

        },

        _updateLinkId : function ( event ) {

            let $linkNameContainer = $(this).closest('div.linkname-container'),
                linkId = $( this ).val();

            $linkNameContainer.find('input').each( function () {
                let type = $(this).closest('div.row').find('select').val();
                $(this).attr( 'id', type + '-' + linkId );
                $(this).attr( 'name', type + '-' + linkId );
            })

            $linkNameContainer.find('span.link-id').html( linkId );


        },

        _removeScript : function ( event ) {

            let $scriptNameContainer = $(this).closest('div.scriptname-container'),
                $scriptRowContainer = $(this).closest('div.scriptrow-container');

            if ( $scriptRowContainer.children('div').length === 1 ) {
                $scriptNameContainer.next('hr').tigerDOM('remove');
                $scriptNameContainer.tigerDOM('remove', function( ) {
                    $('#head-scripts-container, #inline-scripts-container').css('height','auto');
                });
            }
            else {
                $(this).closest('div.row').tigerDOM('remove', function (){
                    // $scriptsRowContainer.css('height','auto');
                    Class._buildExampleLink( $scriptRowContainer );
                });

            }

        },

        _createScriptRow : function ( event ) {

            let $control = '',
                $scriptRowContainer = $(this).closest('.scriptname-container').find('.scriptrow-container'),
                $scriptAttributeRow = '',
                script = {
                    name: "change-me",
                    id: "change-me",
                    value: "change-me",
                    labelAttr: "LABEL.SCRIPT_ATTR",
                    descriptionAttr: "DESCRIPTION.SCRIPT_ATTR",
                    labelValue: "LABEL.SCRIPT_VALUE",
                    descriptionValue: "DESCRIPTION.SCRIPT_VALUE"
                };

            $scriptAttributeRow = $('<div class="row"></div>');
            $control = $().cmsOneUITemplate('scripts', script);
            /** Remove labels and info icons from all but the first attribute to save space ... */
            if ( $scriptRowContainer.children().length > 0 ) {
                $control.find('label, i').not('.button-icon').remove();
            }
            $scriptAttributeRow.append( $control );
            $scriptRowContainer.tigerDOM('insert', {
                content: $scriptAttributeRow,
                callback : function ( ) {

                    $scriptAttributeRow.find('select').select2({
                        minimumResultsForSearch : -1,
                        width : '100%',
                    }).on( 'change', Class._buildExampleScript );

                    $scriptAttributeRow.find('input').on( 'keyup', Class._buildExampleScript );

                    if ( $scriptRowContainer.children().length === 1 ) {
                        $scriptAttributeRow.find('select').val('id').trigger('change');
                    }
                    else {
                        $scriptAttributeRow.find('select').val(null).trigger('change');
                    }

                }
            });

        },

        _createScript : function ( event ) {

            let $content = '',
                $scriptsContainer = $( $(this).data('target') ),
                scriptName = '',
                containerHeader = '',
                $scriptNameContainer = '';

            $content =
                '<div id="change-me" class="scriptname-container">\n' +
                '    <h4><span class="script-id">change-me</span>\n' +
                '        <span id="change-me" class="create-script-attribute">\n' +
                '            <i class="si si-plus js-tooltip-enabled" title="Add new attribute" data-toggle="tooltip" data-placement="left" data-animation="true"></i>\n' +
                '        </span>\n' +
                '    </h4>\n' +
                '    <div class="scriptrow-container"></div>\n' +
                '    <pre class="example"></pre>\n' +
                '</div>\n' +
                '<hr>\n';

            $scriptsContainer.prepend( $content ).children('div').first().find('span.create-script-attribute').click();

            /** Init Tooltips */
            One.helpers('core-bootstrap-tooltip');

        },

        _updateScriptId : function ( event ) {

            let $scriptNameContainer = $(this).closest('div.scriptname-container'),
                scriptId = $( this ).val();

            $scriptNameContainer.find('input').each( function () {
                let type = $(this).closest('div.row').find('select').val();
                $(this).attr( 'id', type + '-' + scriptId );
                $(this).attr( 'name', type + '-' + scriptId );
            })

            $scriptNameContainer.find('span.script-id').html( scriptId );


        },

        _getMetaFormData : function ( ) {

            /**
             * We want to create a JSON object that looks like this ...
             *
             * meta : {
             *      charset : {
             *          "charset" : {
             *              "attributes" : {
             *                  "charset" = "utf-8",
             *              }
             *          },
             *      }
             *      "name" : {
             *          viewport : {
             *              "attributes" : {
             *                  "name" = "viewport",
             *                  "content" = "width=device-width, initial-scale=1"
             *              }
             *          },
             *          description : {
             *              "attributes" : {
             *                  "name" = "description",
             *                  "content" = "Some description ..."
             *              }
             *          },
             *      }
             *  }
             *
             */

            let meta = {}, $container, $elm, elements = [], id, type, name;
            $('.meta-container').each(function (i, container ){
                $container = $(container);
                type = $container.data('type');
                meta[ type ] = {};
                $(container).find('input').each( function (ii, elm) {
                    $elm = $(elm);
                    id = $elm.attr('id');
                    meta[ type ][ id ] = { attributes : {} };
                    name = (id === 'charset') ? 'charset' : $elm.attr('name');
                    meta[ type ][ id ].attributes[ name ] = $elm.val();
                });
            });
            return meta;
        },

        _getLinksFormData : function ( ) {

            /**
             * We want to create a JSON object that looks like this ...
             *
             * links : {
             *      "css-main" : {
             *          "attributes" : {
             *              "id" : "css-main",
             *              "rel" = "stylesheet",
             *              "href" = "/assets/oneui/css/oneui.min.css"
             *          }
             *      },
             *      "something-else" : {
             *          "attributes" : {
             *              "id" : "css-main",
             *              "rel" = "stylesheet",
             *              "href" = "/assets/oneui/css/oneui.min.css"
             *          }
             *      }
             *  }
             *
             */

            let links = {}, elements = [], id = null;
            $('.linkname-container').each(function (i, elm ){
                $elm = $(elm);
                id = $elm.attr('id');
                links[ id ] = { attributes : {} };
                elements = $elm.tigerForm('getFormValues');
                $.each( elements, function (name, value){
                    if ( ! value ){ return true; }
                    links[ id ].attributes[name] = value;
                });
            });
            return links;
        },

        _getHeadScriptsFormData : function ( ) {

            /**
             * We want to create a JSON object that looks like this ...
             *
             * links : {
             *      "css-main" : {
             *          "attributes" : {
             *              "id" : "css-main",
             *              "rel" = "stylesheet",
             *              "href" = "/assets/oneui/css/oneui.min.css"
             *          }
             *      },
             *      "something-else" : {
             *          "attributes" : {
             *              "id" : "css-main",
             *              "rel" = "stylesheet",
             *              "href" = "/assets/oneui/css/oneui.min.css"
             *          }
             *      }
             *  }
             *
             */

            let links = {}, elements = [], id = null;
            $('#head-scripts-container .scriptname-container').each(function (i, elm ){
                $elm = $(elm);
                id = $elm.attr('id');
                links[ id ] = { attributes : {} };
                elements = $elm.tigerForm('getFormValues');
                $.each( elements, function (name, value){
                    if ( ! value ){ return true; }
                    links[ id ].attributes[name] = value;
                });
            });
            return links;
        },

        _getInlineScriptsFormData : function ( ) {

            /**
             * We want to create a JSON object that looks like this ...
             *
             * links : {
             *      "css-main" : {
             *          "attributes" : {
             *              "id" : "css-main",
             *              "rel" = "stylesheet",
             *              "href" = "/assets/oneui/css/oneui.min.css"
             *          }
             *      },
             *      "something-else" : {
             *          "attributes" : {
             *              "id" : "css-main",
             *              "rel" = "stylesheet",
             *              "href" = "/assets/oneui/css/oneui.min.css"
             *          }
             *      }
             *  }
             *
             */

            let links = {}, elements = [], id = null;
            $('#inline-scripts-container .scriptname-container').each(function (i, elm ){
                $elm = $(elm);
                id = $elm.attr('id');
                links[ id ] = { attributes : {} };
                elements = $elm.tigerForm('getFormValues');
                $.each( elements, function (name, value){
                    if ( ! value ){ return true; }
                    links[ id ].attributes[name] = value;
                });
            });
            return links;
        },

        _getTemplateContent : function ( event ) {

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( parseInt( data.result, 10 ) === 1 ) {

                    Class.themeContent = data.data;

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'cms:admin',
                method  : 'getTemplateContent',
                theme : Class.theme,
                template : $(this).val()
            };

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                success     : success,
                error       : error
            });

        },

        // CRUD Functions //

        _add : function ( event ) {

            /** Set the modal header. */
            $('#add-page-header').removeClass('hide');
            $('#edit-page-header').addClass('hide');

            /** Set the modal to the first tab. */
            $('#cms-tabs li:first-child a').tab('show');

            /** Clear the form. */
            $('#page-form').tigerForm('reset');

            /** Init the code editors */
            Class.content = '\r'.repeat(49);
            Class._createAceEditor( Class.content );
            Class._removeCKEditor();
            Class._createCKEditor( Class.content );

            /** Clear the options, meta and links form fields. */
            Class._clearThemeForms();

            /** Hide the version control since we don't need it on add new. */
            $('.save-version').hide();

            /** Show the modal. */
            $('#modal-pages-form').modal('show');

        },

        _edit : function ( event ) {

            $('#add-page-header').addClass('hide');
            $('#edit-page-header').removeClass('hide');
            $('#cms-tabs li:first-child a').tab('show');
            $('.save-version').show();
            $('#page-form').tigerForm('reset');

            function beforeSend ( jqXHR, settings ) {
            }

            function complete ( jqXHR, textStatus ) {
            }

            function success ( data, textStatus, jqXHR ) {

                /** Result Success / Error */

                if ( data.result === 1 ) {

                    Class.content   = data.data.content;
                    Class.theme     = data.data.theme;

                    $('#page-form').tigerForm( 'setFormValues', data.data );
                    Class._createAceEditor( Class.content );
                    // Class._removeCKEditor();
                    // Class._createCKEditor( Class.content );
                    Class._getThemeForms();
                    $('#modal-pages-form').modal( 'show' );

                }
                else {

                    /** Oops, something went wrong ... */

                    $( '#page-messages' ).css('overflow','hidden').tigerDOM( 'change', {
                        content       : data.html[0],
                        removeClick   : true,
                        removeTimeout : 0
                    });

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                let oMessage = {
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );

            };

            let data = {
                service : 'cms:admin',
                method  : 'getPage',
                page_id : $(this).attr('data-id')
            };

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                beforeSend  : beforeSend,
                complete    : complete,
                success     : success,
                error       : error
            });

        },

        _update : function ( event ) {

            /**
             * This function is used to persist not entire forms, but merely small
             * pieces of data, typically from datatables. Yes we do send then entire
             * DT row of data ... but don't really have to.
             */

            let $elm = $(this), data = {};

            function beforeSend () {
            }

            function complete () {
            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if ( parseInt( data.result, 10 ) === 1 ) {

                    /** Update the icon's data-value and class. */

                    if ( $elm.hasClass('active') ) {
                        $elm.attr('data-value', data.data.active);
                        data.data.active = ( parseInt(data.data.active,10) === 1 )
                            ? $elm.removeClass('fa-play').addClass('fa-pause')
                            : $elm.addClass('fa-play').removeClass('fa-pause');
                    }
                    else if ( $elm.hasClass('deleted') ) {
                        $elm.attr('data-value', data.data.deleted);
                        data.data.deleted = ( parseInt(data.data.deleted,10) === 0 )
                            ? $elm.addClass('fa-trash').removeClass('fa-trash-restore')
                            : $elm.removeClass('fa-trash').addClass('fa-trash-restore');
                    }

                }
                else {

                    $( '#page-messages' )
                         .css('overflow', 'hidden')
                         .tigerDOM('change', {
                            content: data.html[0],
                            removeClick: true,
                            removeTimeout: 0
                        });

                }
            }

            function error ( jqXHR, textStatus, errorThrown ) {

                // show general error message
                $( '#page-messages' )
                    .css('overflow', 'hidden')
                    .tigerDOM('change', {
                        content: '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                        removeClick: true,
                        removeTimeout: 0
                    });

            }

            /** Flip the bool before sending to the server. */
            if ( $elm.hasClass('active') ) {
                data.active = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else if ( $elm.hasClass('deleted') ) {
                data.deleted = ( parseInt($elm.attr('data-value'),10) === 1 ) ? 0 : 1;
            }
            else {
                return;
            }

            /** API params tell Tiger what service will be processing the data. */
            data.service = 'cms:admin';
            data.method = 'updatePage';
            data.page_id = $elm.attr('data-id');

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                beforeSend  : beforeSend,
                complete    : complete,
                success     : success,
                error       : error
            });

        },

        _save : function ( event ) {

            function beforeSend () {

                /* Disable any elements if you like. */
                $('#save-button').addClass( 'disabled' ).prop( 'disabled', true );

                /* Toggle the ajax indicators. */
                $('#save-button .ajax').toggleClass( 'hide' );
                $('#save-button .icon').toggleClass( 'hide' );

            }

            function complete () {

                /* Re-enable any elements we disabled. */
                $('#save-button').removeClass( 'disabled' ).prop( 'disabled', false );

                /* Toggle the ajax indicators. */
                $('#save-button .ajax').toggleClass( 'hide' );
                $('#save-button .icon').toggleClass( 'hide' );

            }

            function success ( data, textStatus, jqXHR ) {

                // Success / Error //

                if (parseInt(data.result, 10) === 1) {

                    /** Set the page_id for saved record so the next save is an update to the DB. */
                    if ( data.data.page_id ) {
                        $('#page_id').val( data.data.page_id );
                    }

                    $('#page-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                        content: data.html[0],
                        removeClick: true,
                        removeTimeout: 0
                    });

                }
                else {

                    if ( data.html ) {

                        $('#page-form .form-message')
                            .css('overflow', 'hidden')
                            .tigerDOM('change', {
                                content: data.html[0],
                                removeClick: true,
                                removeTimeout: 0
                            });

                    }

                    if ( data.messages ) {

                        let msgData = {
                            result: 0,
                            form: 'Cms_Form_Page',
                            element: null,
                            messages: []
                        };

                        $.each(data.messages, function (el, msgObj) {

                            msgData.element = el;
                            msgData.messages = [];

                            $.each(msgObj, function (errName, errMsg) {
                                msgData.messages.push({message: errMsg, error: errName, class: "alert"});
                            });

                            $().tigerForm('_setElementMessage', msgData);

                        });

                    }

                }

            }

            function error ( jqXHR, textStatus, errorThrown ) { 

                // show general error message
                let oMessage = { 
                    content       : '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick   : true,
                    removeTimeout : 0
                };

                $( '#form-message' ).css('overflow','hidden').tigerDOM( 'change', oMessage );
                
            }

            /** API params tell Tiger what service will be processing the data. */
            let apiParams = {
                service : 'cms:admin',
                method  : 'savePage',
            };

            /** Note that our API params will be added to the form data */
            let data = $('#btabs-animated-fade-page-content, #btabs-animated-fade-page-scripts, #btabs-animated-fade-settings')
                    .tigerForm('getFormValues', apiParams );

            delete data['ck-content'];
            Class._setContent();

            data.content = Class.content;
            data.options = $('#btabs-animated-fade-page-options').tigerForm('getFormValues');
            data.meta = Class._getMetaFormData();
            data.links = Class._getLinksFormData();
            data.headScripts = Class._getHeadScriptsFormData();
            data.inlineScripts = Class._getInlineScriptsFormData();
            data.styles = $('#styles').val();
            data.scripts = $('#scripts').val();
            data.version = ( $('#save-version').is(':checked') ) ? 1 : 0;

            $.ajax({
                type        : "POST",
                url         : "/api",
                dataType    : "json",
                data        : data,
                beforeSend  : beforeSend,
                complete    : complete,
                success     : success,
                error       : error
            });
            
        },

        _insert : function ( event ) {

            Class.editor.insert( Class.themeContent );

        },

        _homePage : function ( event ) {

            function success(data, textStatus, jqXHR) {

                /** Just show response. */

                $('#route-form .form-message').css('overflow', 'hidden').tigerDOM('change', {
                    content: data.html[0],
                    removeClick: true,
                    removeTimeout: 0
                });

            }

            function error(jqXHR, textStatus, errorThrown) {

                // show general error message
                let oMessage = {
                    content: '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp;' + errorThrown + '</div>',
                    removeClick: true,
                    removeTimeout: 0
                };

                $('#route-form .form-message').css('overflow', 'hidden').tigerDOM('change', oMessage);

            };

            let data = {
                service: 'cms:admin',
                method: 'setHomePage',
                page_id: $('#route_page_id').val()
            };

            $.ajax({
                type: "POST",
                url: "/api",
                dataType: "json",
                data: data,
                success: success,
                error: error
            });

        }

    };
  
    $.fn.cmsAdminIndex = function( method ) {
        if ( Class[method] ) {
            return Class[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return Class.init.apply( this, arguments );
        } else {
            return $.error( 'Method ' +  method + ' does not exist.' );
        }
    };
    
    $().cmsAdminIndex();
    
})( jQuery );
