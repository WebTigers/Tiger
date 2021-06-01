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

trait Account_Service_AddressTrait
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
    public function getAdminAddressDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminAddressSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminAddressSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->address_id;
                $record->controls = $this->_getAddressActions( $record );
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
                'error'             => $validationResponse
            ]);

        }

    }

    /**
     * getAdminAddressSearchList returns a rowset of addresss.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminAddressSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_addressModel->getAdminAddressSearchList( $search, $offset, $limit, $orderby );

    }

    public function getAddressSelect2List ( $params )
    {
        try {

            $entity     = $params['entity'];    // "user" or "org"
            $entity_id  = Zend_Auth::getInstance()->getIdentity()->{ $entity . '_id' };
            $search     = (isset($params['search'])) ? $params['search'] : '';
            $offset     = (isset($params['page'])) ? $params['page'] : 0;
            $limit      = (isset($params['limit'])) ? $params['limit'] : 1;
            $orderby    = (isset($params['order'])) ? $params['order'] : '';

            $results[] = (object) [
                'id' => '',
                'text' => Zend_Registry::get('Zend_Translate')->_('LABEL.ADD_NEW_ADDRESS'),
            ];
            $addressRowset = $this->_addressModel->getAddressSearchList( $entity, $entity_id, $search, $offset, $limit, $orderby );;

            foreach ( $addressRowset as $addressRow) {
                $results[] = (object) [
                    'id' => $addressRow->address_id,
                    'text' => $addressRow->address . ', ' . $addressRow->city . ', ' . $addressRow->state . ' ' . $addressRow->postal_code,
                    'type' => $addressRow->type_address,
                    'primary' => $addressRow->primary,
                    'address' => $addressRow->address,
                    'city' => $addressRow->city,
                    'state' => $addressRow->state,
                    'postal_code' => $addressRow->postal_code,
                ];
            }

        }
        catch ( Error | Exception $e ) {

            $this->_response = new Core_Model_ResponseObjectSelect2([
                'results' => [],
                'pagination' => (object) ['more' => false ],
                'error' => $this->_translate->_('ERROR.ERROR_RETRIEVING_ADDRESSES'),
                'login' => false,
            ]);

            Tiger_Log::error( $e->getMessage() );

        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getAddress ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['address_id'] ) ) {

            $entity = $params['entity'];    // <-- this should either be "user" or "org"
            $entity_id = $this->_auth->getIdentity()->{ $entity . '_id' }; // <-- This could be "user_id" or "org_id"

            $addressRow = $this->_addressModel->getEntityAddressById( $params['address_id'], $entity, $entity_id );

            if ( ! empty( $addressRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $addressRow->toArray();

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

    public function getAdminAddressSelect2List ( $params )
    {

        try {

            if (!isset($params['entity']) || !in_array($params['entity'], ['org', 'user'])) {
                throw new Exception($this->_translate->_('ERROR.INVALID'));
            };

            if (!isset($params['entity_id']) || !Tiger_Utility_Uuid::is_valid($params['entity_id'])) {
                throw new Exception($this->_translate->_('ERROR.ADDRESS_NOT_FOUND'));
            };

            $entitiy = $params['entity'];
            $entitiy_id = $params['entity_id'];
            $search = (isset($params['search'])) ? $params['search'] : '';
            $offset = (isset($params['page'])) ? $params['page'] : 0;
            $limit = (isset($params['limit'])) ? $params['limit'] : 1;
            $orderby = (isset($params['order'])) ? $params['order'] : '';

            $results = [];
            $results[] = (object)['id' => '', 'text' => $this->_translate->_('FORM.ADD_NEW_ADDRESS')];
            $addressRowset = $this->_addressModel->getAdminAddressSearchList( $entitiy, $entitiy_id, $search, $offset, $limit, $orderby );

            foreach ($addressRowset as $addressRow) {
                $results[] = (object)[
                    'id' => $addressRow->address_id,
                    'text' => $addressRow->address . ', ' . $addressRow->city . ', ' . $addressRow->state . ', ' . $addressRow->postal_code,
                    'city' => $addressRow->city,
                    'state' => $addressRow->state,
                    'postal_code' => $addressRow->postal_code,
                    'type' => $addressRow->type_address,
                    'primary' => $addressRow->primary
                ];
            }
        }
        catch (Exception $e ) {

            Tiger_Log::error( $e->getMessage() );

        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    protected function _getAddressActions ( $address ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $address->address_id,                      // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_RESOURCE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $address->address_id,
            'class'     => ( intval($address->active) !== 1 )
                ? 'fa fas fa-play active'
                : 'fa fas fa-pause active',
            'title'     => ( intval($address->active) !== 1 )
                ? $this->_translate->_('DT.ACTIVE_RESOURCE')
                : $this->_translate->_('DT.INACTIVE_RESOURCE'),
            'label'     => ( intval($address->active) !== 1 )
                ? $this->_translate->_('DT.ACTIVE')
                : $this->_translate->_('DT.INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $address->address_id,
            'class'     => ( intval($address->deleted) !== 0 )
                ? 'fa fas fa-trash-restore deleted'
                : 'fa fas fa-trash deleted',
            'title'     => ( intval($address->deleted) !== 0 )
                ? $this->_translate->_('DT.UNDELETE_RESOURCE')
                :  $this->_translate->_('DT.DELETE_RESOURCE'),
            'label'     => ( intval($address->deleted) !== 0 )
                ? $this->_translate->_('DT.UNDELETE')
                : $this->_translate->_('DT.DELETE'),
        ];

        return $actions;

    }

    public function getCountrySearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_countryModel->getCountrySearchList( $search, $offset, $limit, $orderby );

    }

    public function getCountrySelect2List ( $params )
    {

        try {

            $search = (isset($params['search'])) ? $params['search'] : '';
            $offset = (isset($params['page'])) ? $params['page'] : 0;
            $limit = (isset($params['limit'])) ? $params['limit'] : 1;
            $orderby = (isset($params['order'])) ? $params['order'] : '';

            $results = [];
            $countryRowset = $this->getCountrySearchList( $search, $offset, $limit, $orderby );

            foreach ($countryRowset as $countryRow) {
                $results[] = (object) [
                    'id' => $countryRow->code,
                    'text' => $countryRow->name,
                ];
            }
        }
        catch (Exception $e ) {

            pr( $e->getMessage() );

        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    public function getAddressLookupAWS ( $params ) {

        /** If the AWS Location Services are not configued, attempt to fail gracefully. */
        if ( ! isset( Zend_Registry::get('Zend_Config')->aws->client ) || ! isset( Zend_Registry::get('Zend_Config')->aws->location ) ) {
            $this->_response->result = 0;
            $this->_response->data = 'not_configured';
            return;
        }

        try {

            // https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.LocationService.LocationServiceClient.html
            // https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-location-2020-11-19.html#searchplaceindexfortext

            $clientConfigs = Zend_Registry::get('Zend_Config')->aws->client->toArray();
            $client = new \Aws\LocationService\LocationServiceClient( $clientConfigs );
            $location = Zend_Registry::get('Zend_Config')->aws->location;

            $config = [
                // 'BiasPosition'      => [],                       // <float>, ...
                // 'FilterBBox'        => [],                       // <float>, ...
                'FilterCountries'   => explode(',', $location->filterCountries ),  // '<string>', like: USA,CAN,MEX
                'IndexName'         => $location->indexName,        // REQUIRED, <string>
                'MaxResults'        => $location->maxResults,       // <integer>, like 10
                'Text'              => $params['address'],          // REQUIRED, <string>
            ];

            $result = $client->searchPlaceIndexForText( $config );

            $this->_response->result = 1;
            $this->_response->data = $result->toArray();
            $this->_response->setTextMessage( 'MESSAGE.SUCCESS', 'success');

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'alert');

            Tiger_Log::error( $e->getMessage() );

        }

    }

    public function removeAddress ( $params ) {

        $entity = $params['entity'];    // <-- this should either be "user" or "org"
        $entity_id = $this->_auth->getIdentity()->{ $entity . '_id' };  // <-- This could be "user_id" or "org_id"

        Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

        try {

            $addressRow = $this->_addressModel->getEntityAddressById( $params['address_id'], $entity, $entity_id );
            $entityLinkRow = $this->{'_' . $entity . 'AddressModel'}->getEntityAddressByEntityId( $entity_id, $params['address_id'] );

            if ( ! empty( $addressRow ) && ! empty( $entityLinkRow ) ) {

                $addressRow->deleted = 1;
                $addressRow->saveRow();
                $entityLinkRow->deleted = 1;
                $entityLinkRow->saveRow();

                /** Commit the DB transaction. All done! */
                Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

                /**
                 * Populate the responseObject with our success.
                 */
                $this->_response->result = 1;
                $this->_response->setTextMessage('MESSAGE.ADDRESS_REMOVED', 'success');

            }

        }
        catch ( Error | Exception $e ) {

                /** Uh oh, something went wrong, rollback all database activity! */
                Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

                $this->_response->result = 0;
                $this->_response->setTextMessage( 'MESSAGE.ADDRESS_REMOVE_FAILED', 'alert' );

                /** We also log what happened ... */
                Tiger_Log::error( $e->getMessage() );

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
    public function updateAddress ( $params ) {

        $this->_form = new Account_Form_Address();

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
        $data = $this->_form->getValues();

        try {

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the address being persisted
             * we don't need the $addressRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $addressRow = $this->_persistAddress( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $address = (object) $addressRow->toArray();
            $address->action = $this->_getAddressActions( $address );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $address;
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
     * Service "save" methods essentially are the gateway to persisting whole forms
     * of data. Save is responsible for validating and then forwarding clean data to
     * the "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function saveAddress ( $params ) {

        /**
         * Since both admins and users will be persisting via this method,
         * check to see if we have admin or user profile. The user will be
         * accessing this saveAddress from the "Account_Service_Account" class.
         */
        if ( $this->_reflection->getShortName() === 'Account_Service_Account' ) {

            $params['entity_id'] = Zend_Auth::getInstance()->getIdentity()->{ $params['entity'] . '_id' };
            $params['active'] = 1;
            $params['deleted'] = 0;

        }

        try {

            $this->_form = new Account_Form_Address();

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

            /** Massage some data if it's empty ... */
            $data['lat'] = ( ! empty( $data['lat'] ) ) ? $data['lat'] : 0.0;
            $data['lng'] = ( ! empty( $data['lng'] ) ) ? $data['lng'] : 0.0;

            /**
             * Normally, we don't need the $dataRow, but we need it now to pass
             * our new id to the linking table. Since the addressRow record
             * does not know who it belongs to, we also need to pass our data into
             * the persist method so the linking table knows who the entity (whether
             * a user or and org) is.
             */
            $addressRow = $this->_persistAddress( $data );
            $addressRow = $this->_persistEntityAddress( $data, $addressRow );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $addressRow;
            $this->_response->setTextMessage( 'MESSAGE.ADDRESS_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.ADDRESS_SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * PersistAddress is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated address_id, the persist will be treated as an update.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    protected function _persistAddress( array $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a address_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['address_id'] ) ) {

            $addressRow = $this->_addressModel->getAddressById( $data['address_id'] );

            if ( empty($addressRow) ) {
                throw new Exception('ERROR.CONTACT_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $addressRow->setFromArray( $data );

            }
            else {

                unset( $data['user_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $addressRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $addressRow = $this->_addressModel->createRow( $data );

            /**
             * Update the relevant pieces with new address system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $addressRow->address_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new address to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $addressRow->saveRow();
        return $addressRow;

    }

    /**
     * Persist the linking table data. Note that we only need to do this for new records.
     *
     * @param array $data
     * @param Zend_Db_Table_Row $addressRow
     */
    protected function _persistEntityAddress ( array $data, Zend_Db_Table_Row $addressRow ) {

        if ( empty( $data['address_id'] ) ) {

            /** Select the appropriate entity model ... */

            switch ( $data['entity'] ) {
                case 'org':
                    $entityModel = $this->_orgAddressModel;
                    $entityData = [
                        'org_address_id' => Tiger_Utility_Uuid::v1(),
                        'org_id' => $data['entity_id'],
                    ];
                    break;
                case 'user':
                default:
                    $entityModel = $this->_userAddressModel;
                    $entityData = [
                        'user_address_id' => Tiger_Utility_Uuid::v1(),
                        'user_id' => $data['entity_id'],
                    ];
                    break;
            }

            /** Create the row with our relevant data. */
            $entityAddressRow = $entityModel->createRow( $entityData );

            /** Update the relevant pieces with new address data. */
            $entityAddressRow->address_id = $addressRow->address_id;

            $entityAddressRow->saveRow();

        }

    }

}