<?php

class Acl_Service_Admin
{
    protected $_auth;
    protected $_acl;
    protected $_locale;
    protected $_translate;
    protected $_config;
    protected $_response;
    protected $_request;
    protected $_form;
    protected $_reflection;
    protected $_searchErrors;

    protected $_resourceModel;
    protected $_roleModel;
    protected $_ruleModel;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_response    = new Core_Model_ResponseObject();

        $this->_resourceModel   = new Acl_Model_AclResources;
        $this->_roleModel       = new Acl_Model_AclRoles;
        $this->_ruleModel       = new Acl_Model_AclRules;

        if ( $input instanceof Zend_Controller_Request_Http ) {
            $this->_request = $input;
            $params = $this->_request->getParams();
        }
        elseif ( is_array($input) ) {
            $params = $input;
        }

        if ( ! isset( $this->_reflection ) ) {
            $this->_reflection = new ReflectionClass( $this );
        }

        if ( isset( $params['form'] ) && class_exists( $params['form'], true ) ) {
            $this->_form = new $params['form'];
        }

        $this->_dispatch( $params );

    }


    ### Boilerplate Internal Class Functions ###

    /**
     * If this service is called via the API, the dispatch
     * method will route the $params to the proper function.
     * @param type $params
     */
    private function _dispatch ( $params ) {

        try {

            if ( isset( $params['method'] ) ) {

                // filter the method to just camelCase alphaNumeric for security
                $method = Zend_Filter::filterStatic( $params['method'],
                    'PregReplace', array('match' => '/[^A-Za-z0-9]/', 'replace' => '') );

                // make sure the method exists and that it's public
                if ( method_exists( $this, $method ) &&
                    $this->_reflection->getMethod( $method )->isPublic() ) {
                    $this->{$method}( $params );
                }
            }
        }

        catch ( Exception $e ) {

            // @TODO Need to log this

        }

    }

    /**
     * Gets the Core ResponseObject
     * @return object of ResponseObject
     */
    public function getResponse() {
        return $this->_response;
    }

    /**
     * Convenience function used to set form errors. Call the function
     * without passing in a form to use the set form for the service,
     * or pass in a different form to set the responseObject from it.
     * @param null $frm
     */
    protected function _setFormErrors ( $frm = null ) {

        $form = ( ! is_null( $frm ) ) ? $frm : $this->_form;

        $this->_response->result    = 0;
        $this->_response->form = $form->getName();
        $this->_response->messages  = $form->getMessages();

    }


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
    public function getAdminResourcesDataTable ( $post ) {

        if ( $this->_validateDataTables( $post ) ) {

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
            $recordsTotalRowset = $this->getAdminResourceSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminResourceSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->resource_id;
                $record->controls = $this->_getResourceActions( $record );
                $recordsOut[] = $record;

            }

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
            ]);

        }
        else {

            /** Set an empty the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => 0,
                'recordsFiltered'   => 0,
                'data'              => [],
                'error'             => $this->_searchErrors
            ]);

        }

    }

    /**
     * getAdminResourceSearchList returns a rowset of resources.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminResourceSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' ) {
        return $this->_resourceModel->getAdminResourceSearchList( $search, $offset, $limit, $orderby );
    }


    ### Validation Methods ###

    protected function _validateDataTables ( Array $post ) {

        // pr($post);

        $regexValidator = new Zend_Validate_Regex( array('pattern' => '/^[A-Za-z0-9 \'\.\_\-,]+$/') );
        $intValidator   = new Zend_Validate_Int();

        $out = array();

        if ( ! empty($post['search']) && ! $regexValidator->isValid( $post['search'] ) ) {
            foreach ( $regexValidator->getMessages() as $messageId => $message ) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['start'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['length'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        return ( empty($out) ) ? true : $this->_searchErrors = $out;

    }

    protected function _getResourceActions ( $resource ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $resource->resource_id,                      // Gets built as a data-id attribute.
            'class'     => 'fa fas fa-pencil-alt',                    // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_RESOURCE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = ( intval($resource->active) !== 1 )
            ? (object) [
                'type'      => 'icon',
                'id'        => $resource->resource_id,
                'class'     => 'fa fas fa-play',
                'title'     => $this->_translate->_('DT.ACTIVE_RESOURCE'),
                'label'     => $this->_translate->_('DT.ACTIVE'),
            ]
            : (object) [
                'type'      => 'icon',
                'id'        => $resource->resource_id,
                'class'     => 'fa fas fa-pause',
                'title'     => $this->_translate->_('DT.INACTIVE_RESOURCE'),
                'label'     => $this->_translate->_('DT.INACTIVE'),
            ];

        $actions[] = ( intval($resource->deleted) !== 0 )
            ? (object) [
                'type'      => 'icon',
                'id'        => $resource->resource_id,
                'class'     => 'fa fas fa-trash-restore',
                'title'     => $this->_translate->_('DT.UNDELETE_RESOURCE'),
                'label'     => $this->_translate->_('DT.UNDELETE'),
            ]
            : (object) [
                'type'      => 'icon',
                'id'        => $resource->resource_id,
                'class'     => 'fa fas fa-trash',
                'title'     => $this->_translate->_('DT.DELETE_RESOURCE'),
                'label'     => $this->_translate->_('DT.DELETE'),
            ];;

        return $actions;

    }


    ### Persistence Methods ###

    /**
     * Service "save" methods essentially are the gateway to persisting our data.
     * Save is responsible for validating and then forwarding clean data to the
     * "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function saveResource ( $params ) {

        $this->_form = new Acl_Form_Resource();

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

        try {

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the resource being persisted
             * we don't need the $resourceRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $resourceRow = $this->_persistResource( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $resourceRow;
            $this->_response->setTextMessage( 'MESSAGE.RESOURCE_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NEWUSER_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }

    }

    /**
     * PersistResource is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a resource_id, the persist will be treated as an update.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    protected function _persistResource( $data )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a resource_id, then we know this is an update. */
        if ( isset($data['resource_id']) ) {

            $resourceRow = $this->_resourceModel->getResourceById( $data['resource_id'] );

            if ( empty($resourceRow) ) {
                throw new Exception('ERROR.RESOURCE_NOT_FOUND');
            }

            $resourceRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $resourceRow = $this->_resourceModel->createRow( $data );

            /** Update the relevant pieces with new resource data. */
            $resourceRow->resource_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new resource to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $resourceRow->saveRow();
        return $resourceRow;

    }





}
