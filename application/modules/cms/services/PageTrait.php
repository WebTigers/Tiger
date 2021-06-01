<?php

trait Cms_Service_PageTrait
{
    ### Admin Service Functions ###

    /**
     * Perhaps one of the more complicated API calls is for DataTables. DataTables posts
     * a boatload of varied params based on the data within table. These DataTables functions
     * consume that set of params and organize it into something our models can deal with.
     *
     * This DataTable function is a pattern repeated over and over within Tiger and is easily
     * copy and paste for your unique DataTables use cases within the Tiger platform.
     *
     * @param $post
     * @return object DataTables response
     */
    public function getAdminPagesDataTable ( $post ) {

        $validationResponse = $this->_utility->validateDataTables( $post );

        if ( $validationResponse === true ) {

            /** Are we ordering by some column(s)? */
            $orderby = '';
            if ( count($post['order']) > 0 ) {
                foreach ( $post['order'] as $order) {
                    $columnNumber = $order['column'];
                    $direction = $order['dir'];
                    $orderby .= $post['columns'][$columnNumber]['name'] . " " . $direction . ", ";
                }
                $orderby = substr($orderby, 0, -2);
            }

            /** DataTables needs a filtered count for pagination */
            $recordsTotalRowset = $this->getAdminPageSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminPageSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->page_id;
                $record->controls = $this->_getPageActions( $record );
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.PAGE_ID',
                'DT.NAME',
                'DT.KEY',
                'DT.TYPE',
                'DT.CATEGORY',
                'DT.CONTENT',
                'DT.LOCALE',
                'DT.CREATE_DATE',
                'DT.UPDATE_DATE',
                'DT.ACTIONS',
                'DT.HISTORY',
                'DT.ACTIVE',
                'DT.DELETED',
            ]);

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
                'i18n'              => $headers,
            ]);

        }
        else {

            /** Set an empty the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => 0,
                'recordsFiltered'   => 0,
                'data'              => [],
                'error'             => $validationResponse
            ]);

        }

    }

    /**
     * getAdminPageSearchList returns a rowset of pages.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminPageSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_pageModel->getAdminPageSearchList( $search, $offset, $limit, $orderby );

    }

    protected function _getPageActions ( $page ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $page->page_id,                              // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_RESOURCE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $page->page_id,
            'value'     => $page->active,
            'class'     => ( intval($page->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_RESOURCE'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $page->page_id,
            'value'     => $page->deleted,
            'class'     => ( intval($page->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_RESOURCE'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

    }

    public function getPage ( $params ) {

        if ( Tiger_Utility_Uuid::is_valid( $params['page_id'] ) ) {

            $pageRow = $this->_pageModel->getPageById( $params['page_id'] );

            if ( ! empty( $pageRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $pageRow->toArray();


            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage('ERROR.NOT_FOUND', 'alert');

            }

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.INVALID', 'alert');

        }

    }

    public function getThemes ( ) {

        $themes = [ '' => $this->_translate->translate('OPTION.SELECT_THEME') ];

        $themeArr = Tiger_Utility_Themes::getThemesList()->toArray();

        foreach ( $themeArr as $theme => $data ) {

            $this->getLayoutSelect2List( ['theme' => $theme] );
            $themes[$theme]['layouts'] = $this->_response->results;

            $this->getSchemeSelect2List( ['theme' => $theme] );     // Just sets the response object.
            $themes[$theme]['schemes'] = $this->_response->results;

            $this->getTemplatesSelect2List( ['theme' => $theme] );     // Just sets the response object.
            $themes[$theme]['templates'] = $this->_response->results;

        }

        $this->_response = new Core_Model_ResponseObject();

        $this->_response->result = 1;
        $this->_response->data = $themes;

    }

    public function getLayoutSelect2List ( $params ) {

        /** Set an empty option. */
        $out = [ (object) [
                'id' => '',
                'text' => $this->_translate->translate( 'OPTION.SELECT_LAYOUT' ),
            ]
        ];

        /** Set options from config. */
        $layouts = Tiger_Utility_Themes::getLayoutList( $params );
        foreach( $layouts as $name => $data ) {
            $out[] = (object) [
                'id' => $data['path'],
                'text' => $this->_translate->translate( $data['name'] ),
            ];
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $out,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getSchemeSelect2List ( $params ) {

        $schemes = Tiger_Utility_Themes::getSchemeList( $params );

        $out = [
            (object)[
                'id' => '',
                'text' => $this->_translate->translate( 'LABEL.DEFAULT_SCHEME' ),
            ]
        ];
        foreach( $schemes as $name => $path ) {
            $out[] = (object) [
                'id' => $path,
                'text' => $this->_translate->translate( $name ),
            ];
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $out,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getPageSelect2List ( $params ) {

        $params['search'] = ( isset( $params['search'] ) ) ? $params['search'] : '';

        $pages = $this->_pageModel->getPagesForSelect2( $params['search'] );

        $out = [
            (object) [
                'id' => '',
                'text' => $this->_translate->translate( 'LABEL.DEFAULT_SCHEME' ),
            ]
        ];
        foreach( $pages as $page ) {
            $out[] = (object) [
                'id' => $page->page_id,
                'text' => $page->name ,
            ];
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $out,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getThemePageConfigDefaults ( $params ) {

        if ( Tiger_Utility_Themes::isTheme( $params['theme'] ) ) {

            $themeConfig = Tiger_Utility_Themes::getThemeConfig( $params['theme'] );

            if ( ! empty( $theme ) ) {

                $this->_response->result = 1;
                $this->_response->data['config'] = $themeConfig;


            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage('ERROR.NOT_FOUND', 'alert');

            }

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.INVALID', 'alert');

        }

    }

    public function getThemeFormFields ( $params ) {

        if ( Tiger_Utility_Themes::isTheme( $params['theme'] ) ) {

            $formClass = ucfirst( strtolower( $params['theme'] ) ) . '_Form_Options';
            $form = new $formClass();

            $meta           = Tiger_Utility_Themes::getThemeMeta( $params );
            $links          = Tiger_Utility_Themes::getThemeHeadLinks( $params );
            $headScripts    = Tiger_Utility_Themes::getThemeHeadScripts( $params );
            $inlineScripts  = Tiger_Utility_Themes::getThemeInlineScripts( $params );

            $data = (object) [
                'options'       => $this->_getElementsFromThemeOptionsForm( $form ),
                'meta'          => $this->_getElementsFromThemeMetaConfigs( $meta ),
                'links'         => $this->_getElementsFromThemeHeadLinksConfigs( $links ),
                'headScripts'   => $this->_getElementsFromThemeScriptsConfigs( $headScripts ),
                'inlineScripts' => $this->_getElementsFromThemeScriptsConfigs( $inlineScripts ),
            ];

            $this->_response->result = 1;
            $this->_response->data = $data;

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.INVALID', 'alert');

        }

    }

    protected function _getElementsFromThemeOptionsForm( $form ) {

        /**
         * Unfortunately, Zend Form doesn't have an element to array feature,
         * so for the time being this allows us to export all of the form elements
         * as an array that can be sent to the UI for reconstruction. We could have
         * just sent back the elements pre-rendered, but this seems more concise
         * if not more elegant and re-usable.
         */

        // $elm = new Oneui_Form_Options();
        // $elm->getElement()->getType()

        $elements = $form->getElements();
        $out = [];
        foreach ( $elements as $element ) {

            $elementType = explode( '_', $element->getType() );
            $type  = strtolower( array_pop( $elementType ) );

            switch ( $type ) {
                case 'select':
                    $elem = 'select';
                    $type = 'select';
                    break;
                case 'textarea':
                    $elem = 'textarea';
                    $type = 'textarea';
                    break;
                // case 'text':
                // case 'radio':
                // case 'checkbox':
                default:
                    $elem = 'input';
                    break;
            }

            $out[] = (object) [
                'id'            => $element->getId(),
                'name'          => $element->getName(),
                'element'       => $elem,   // input, select, textarea
                'type'          => $type,   // text, checkbox, radio
                'label'         => $this->_translate->translate( $element->getLabel() ),
                'description'   => $this->_translate->translate( $element->getDescription() ),
                'attribs'       => $element->getAttribs(),
            ];

        }

        return $out;

    }

    protected function _getElementsFromThemeMetaConfigs( $meta ) {

        $out = [];

        // Type is like charset, name, or opengraph. //
        foreach( $meta as $type => $typeObj ) {

            foreach( $typeObj as $name => $nameObj ) {

                // Name is like charset, viewport, description, etc. //
                foreach ($nameObj['attributes'] as $attr => $value) {

                    $out[] = (object)[
                        'meta' => $type,
                        'id' => $attr,
                        'name' => $attr,
                        'element' => 'input',
                        'type' => 'text',
                        'value' => $value,
                        'label' => $this->_translate->translate('LABEL.META_' . strtoupper($attr)),
                        'description' => $this->_translate->translate('DESCRIPTION.META_' . strtoupper($attr)),
                    ];

                }

            }

        }

        return $out;

    }

    protected function _getElementsFromThemeHeadLinksConfigs( $links ) {

        $out = [];

        // Type is like charset, name, or opengraph. //
        foreach( $links as $name => $nameObj ) {

            // pr([ $name, $nameObj ]);

            // Name is like charset, viewport, description, etc. //
            foreach ($nameObj['attributes'] as $attr => $value) {

                $out[] = (object)[
                    'link' => $name,
                    'id' => $attr . '-' . $name,
                    'name' => $attr,
                    'element' => 'input',
                    'type' => 'text',
                    'value' => $value,
                    'labelAttr' => $this->_translate->translate('LABEL.LINK_ATTR'),
                    'descriptionAttr' => $this->_translate->translate('DESCRIPTION.LINK_ATTR'),
                    'labelValue' => $this->_translate->translate('LABEL.LINK_VALUE'),
                    'descriptionValue' => $this->_translate->translate('DESCRIPTION.LINK_VALUE'),
                ];

            }

        }

        return $out;

    }

    protected function _getElementsFromThemeScriptsConfigs( $scripts ) {

        $out = [];

        // Type is like charset, name, or opengraph. //
        foreach( $scripts as $name => $nameObj ) {

            // Name is like charset, viewport, description, etc. //
            $nameObj['attributes'] = ( isset($nameObj['attributes']) ) ? $nameObj['attributes'] : [];
            foreach ($nameObj['attributes'] as $attr => $value) {

                $out[] = (object)[
                    'script' => $name,
                    'id' => $attr . '-' . $name,
                    'name' => $attr,
                    'element' => 'input',
                    'type' => 'text',
                    'value' => $value,
                    'labelAttr' => $this->_translate->translate('LABEL.SCRIPT_ATTR'),
                    'descriptionAttr' => $this->_translate->translate('DESCRIPTION.SCRIPT_ATTR_VALUE'),
                    'labelValue' => $this->_translate->translate('LABEL.SCRIPT_VALUE'),
                    'descriptionValue' => $this->_translate->translate('DESCRIPTION.SCRIPT_ATTR_VALUE'),
                ];

            }

        }

        return $out;

    }

    public function getTemplatesSelect2List( $params ) {

        $templates = Tiger_Utility_Themes::getThemeTemplates( $params );

        $out = [ (object) [
                'id' => '',
                'text' => $this->_translate->translate( 'OPTION.SELECT_TEMPLATE' ),
            ]
        ];

        foreach( $templates as $name => $data ) {
            $out[] = (object) [
                'id'        => $name,
                'text'      => $data->package . ' - ' . $data->name,
                'image'     => $data->image,
                'filename'  => $data->filename,
            ];
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $out,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getTemplateContent ( $params ) {

        $content = Tiger_Utility_Themes::getThemeTemplateContent( $params );

        $this->_response->result = 1;
        $this->_response->data = $content;

    }

    public function setHomePage ( $params ) {

        if ( isset( $params['page_id'] ) ) {

            $configModel = new Core_Model_Config();

            if ( Tiger_Utility_Uuid::is_valid( $params['page_id'] ) ) {

                $configRow = $configModel->getAdminConfigByKey('routes.default.defaults.module');
                $configRow->value = 'cms';
                $configRow->active = 1;
                $configRow->saveRow();

                $configRow = $configModel->getAdminConfigByKey('routes.lang_default.defaults.module');
                $configRow->value = 'cms';
                $configRow->active = 1;
                $configRow->saveRow();

                $configRow = $configModel->getAdminConfigByKey('tiger.cms.default_home_page_id');
                $configRow->value = $params['page_id'];
                $configRow->active = 1;
                $configRow->saveRow();

            }
            else {

                /** We really only need to make these configs inactive to shut off the setting. */

                $configRow = $configModel->getAdminConfigByKey('routes.default.defaults.module');
                $configRow->active = 0;
                $configRow->saveRow();

                $configRow = $configModel->getAdminConfigByKey('routes.lang_default.defaults.module');
                $configRow->active = 0;
                $configRow->saveRow();

                $configRow = $configModel->getAdminConfigByKey('tiger.cms.default_home_page_id');
                $configRow->active = 0;
                $configRow->saveRow();

            }

            $this->_response->result = 0;
            $this->_response->setTextMessage('SUCCESS.HOME_PAGE_SETTING_UPDATED', 'success');

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.INVALID', 'alert');

        }

    }

    ### Persistence Methods ###

    /**
     * Service "update" methods essentially are the gateway to persisting small
     * pieces of form data. Update is responsible for validating and then forwarding
     * the tiny bits of clean data to the "persist" method for any grooming which
     * is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function updatePage ( $params ) {

        $this->_form = new Cms_Form_Page();

        /**
         * Note that in Tiger, isValid() is subclassed to remove any request routing
         * params that are not part of the form. If you wish to preserve the entire
         * $params array, call the $form->isValidPreserve() method instead.
         */
        if ( ! $this->_form->isValidPartial( $params ) ) {

            /**
             * We use a convenience method to set the form errors into
             * the responseObject and we're done here.
             */
            $this->_setFormErrors();
            return;

        }

        /** Gets the filtered and validated values from the form. We've got clean data. */
        $data = $this->_form->getValidValues( $params );

        try {

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the page being persisted
             * we don't need the $pageRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $pageRow = $this->_persistPage( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $pageRow->toArray();
            $this->_response->setTextMessage( 'MESSAGE.MEDIA_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NEW_MEDIA_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }

    }

    /**
     * Service "save" methods essentially are the gateway to persisting whole forms
     * of data. Save is responsible for validating and then forwarding clean data to
     * the "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function savePage ( $params ) {

        $params['options']          = ( isset($params['options']) ) ? json_encode( $params['options'] ) : '';
        $params['meta']             = ( isset($params['meta']) ) ? json_encode( $params['meta'] ) : '';
        $params['links']            = ( isset($params['links']) ) ? json_encode( $params['links'] ) : '';
        $params['headScripts']      = ( isset($params['headScripts']) ) ? json_encode( $params['headScripts'] ) : '';
        $params['inlineScripts']    = ( isset($params['inlineScripts']) ) ? json_encode( $params['inlineScripts'] ) : '';

        // pr( $params );

        try {

            $this->_form = new Cms_Form_Page();

            /**
             * Note that in Tiger, isValid() is subclassed to remove any request routing
             * params that are not part of the form. If you wish to preserve the entire
             * $params array, call the $form->isValidPreserve() method instead.
             */
            if ( ! $this->_form->isValid( $params ) ) {

                /**
                 * We use a convenience method to set the form errors into
                 * the responseObject and we're done here.
                 */
                $this->_setFormErrors();
                return;

            }

            /** Gets the filtered and validated values from the form. We've got clean data. */
            $data = $this->_form->getValues();

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the page being persisted
             * we don't need the $pageRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $pageRow = $this->_persistPage( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $pageRow->toArray();
            $this->_response->setTextMessage( 'MESSAGE.PAGE_SAVED', 'success' );

        }
        catch ( Exception | Error $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

            pr( $e->getMessage() );

        }

    }

    /**
     * PersistPage is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated page_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @throws Exception
     * @return mixed
     */
    protected function _persistPage( array $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a page_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['page_id'] ) ) {

            $pageRow = $this->_pageModel->getPageById( $data['page_id'] );

            if ( empty($pageRow) ) {
                throw new Exception('ERROR.MEDIA_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $pageRow->setFromArray( $data );

            }
            else {

                unset( $data['page_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $pageRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $pageRow = $this->_pageModel->createRow( $data );

            /** Update the relevant pieces with new page data. */
            $pageRow->page_id = Tiger_Utility_Uuid::v1();
            $pageRow->active = 1;

        }

        /**
         * Now we can save the new page to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $pageRow->saveRow();

        return $pageRow;

    }

}