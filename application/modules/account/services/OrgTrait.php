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

trait Account_Service_OrgTrait
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
    public function getAdminOrgsDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminOrgSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminOrgSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->org_id;
                $record->controls = $this->_getOrgActions( $record );
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.ORGNAME',
                'DT.COMPANY_NAME',
                'DT.DISPLAY_NAME',
                'DT.ORG_DESCRIPTION',
                'DT.REFERRAL_CODE',
                'DT.ACTIONS',
                'DT.ORG_ID',
                'DT.PARENT_ORG_ID',
                'DT.TYPE_ORG',
                'DT.DOMAIN',
                'DT.ACTIVE',
                'DT.DELETED',
            ]);

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
                'i18n'              => $headers
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
     * getAdminOrgSearchList returns a rowset of orgs.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminOrgSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_orgModel->getAdminOrgSearchList( $search, $offset, $limit, $orderby );

    }

    public function getProfileOrg ( $params )
    {
        $params['user_id']  = $this->_auth->getIdentity()->user_id;
        $params['org_id']   = $this->_auth->getIdentity()->org_id;

        $orgRow = $this->_orgModel->getPrimaryOrgByUser( $params['user_id'],  $params['org_id'] );

        if ( ! empty( $orgRow ) ) {

            /** Profile users are not allowed to edit the DEFAULT org. */
            if ( $orgRow->type_org === 'DEFAULT' || $orgRow->type_user_role === 'MEMBER' ) {
                $this->_response->data = [
                    'type_org' => $orgRow->type_org,
                    'type_user_role' => $orgRow->type_user_role
                ];
            }
            else {
                $this->_response->data = $orgRow->toArray();
            }

            $this->_response->result = 1;

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.NOT_FOUND', 'alert');

        }

    }

    public function getOrg ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['org_id'] ) ) {

            $orgRow = $this->_orgModel->getOrg( $params['org_id'] );

            if ( ! empty( $orgRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $orgRow->toArray();

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

    public function getOrgSelect2List ( $params )
    {
        $search     = ( isset( $params['search'] ) ) ? $params['search'] : '';
        $offset     = ( isset( $params['page']   ) ) ? $params['page']   : 0;
        $limit      = ( isset( $params['limit']  ) ) ? $params['limit']  : 1;
        $orderby    = ( isset( $params['order']  ) ) ? $params['order']  : '';

        $results = [];
        $orgRowset = $this->_orgModel->getOrgSearchList( $search, $offset, $limit, $orderby );

        foreach ( $orgRowset as $orgRow ) {
            $results[] = (object) ['id' => $orgRow->org_id, 'text' => $orgRow->orgname . ' - ' . $orgRow->org_display_name ];
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    protected function _getOrgActions ( $org ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $org->org_id,                                // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_ORG'),         // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $org->org_id,                                // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fa fa-address-card address',             // The class for the icon or button.
            'title'     => $this->_translate->_('DT.ADDRESS'),          // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.ADDRESS'),          // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $org->org_id,                                // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fa fa-mobile-alt contact',               // The class for the icon or button.
            'title'     => $this->_translate->_('DT.CONTACT'),          // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.CONTACT'),          // The title attribute.
        ];


        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $org->org_id,
            'value'     => $org->active,
            'class'     => ( intval($org->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_ORG'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $org->org_id,
            'value'     => $org->deleted,
            'class'     => ( intval($org->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_ORG'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

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
    public function updateOrg ( $params ) {

        $this->_form = new Account_Form_Org();

        /**
         * One of the first things to check for is the existence of unique fields
         * within the saveOrg payload. Tiger will complain if we try to re-insert
         * or update the org record with the same email or orgname. This function
         * simply removes certain form validators. Note that this function only works
         * if passed a org_id as part of the params payload.
         */
        $this->_removeUniqueOrgValidation( $params );

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
             * Since we're not really doing anything with the org being persisted
             * we don't need the $orgRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $orgRow = $this->_persistOrg( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $org = (object) $orgRow->toArray();
            $org->action = $this->_getOrgActions( $org );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $org;
            $this->_response->setTextMessage( 'MESSAGE.ORG_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.UPDATE_FAILED', 'alert' );

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
    public function saveOrg ( $params ) {

        /**
         * Since both admins and users will be persisting via this method,
         * check to see if we have admin or user profile. The user will be
         * accessing this saveAddress from the "Account_Service_Account" class.
         */
        if ( $this->_reflection->getShortName() === 'Account_Service_Account' ) {
            $params['active'] = 1;
            $params['deleted'] = 0;
        }

        try {

            $this->_form = new Account_Form_Org();

            /**
             * One of the first things to check for is the existence of unique fields
             * within the saveOrg payload. Tiger will complain if we try to re-insert
             * or update the org record with the same email or orgname. This function
             * simply removes certain form validators. Note that this function only works
             * if passed a org_id as part of the params payload.
             */
            $this->_removeUniqueOrgValidation( $params );

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
             * Since we're not really doing anything with the org being persisted
             * we don't need the $orgRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $orgRow = $this->_persistOrg( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $orgRow;
            $this->_response->setTextMessage( 'MESSAGE.ORG_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }
        catch ( Error $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }

    }

    /**
     * PersistOrg is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the org table. If you
     * pass in a populated org_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @return mixed
     * @throws Exception
     */
    protected function _persistOrg( $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a org_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['org_id'] ) ) {

            $orgRow = $this->_orgModel->getOrgById( $data['org_id'] );

            if ( empty($orgRow) ) {
                throw new Exception('ERROR.ORG_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $orgRow->setFromArray( $data );

            }
            else {

                unset( $data['org_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $orgRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $orgRow = $this->_orgModel->createRow( $data );

            /**
             * Update the relevant pieces with new org system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $orgRow->org_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new org to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this org. In our use case
         * we simply return the entire row object.
         */
        $orgRow->saveRow();
        return $orgRow;

    }

    /**
     * @param $params array
     */
    protected function _removeUniqueOrgValidation ( $params )
    {
        /** If the org_id is empty, this is an insert and we don't need to be here. */
        if ( empty( $params['org_id'] ) ) { return; }

        /** If the org_id is not a valid UUID, we're outta here. */
        if ( ! Tiger_Utility_Uuid::is_valid( $params['org_id'] ) ) { return; }

        $orgRow = $this->_orgModel->getOrgById( $params['org_id'] );

        /** If there is no record for the org_id, then we're outta here as well. */
        if ( empty( $orgRow ) ){ return; }

        /** If the orgname is the same as the org's existing record, removed the validator. */
        if ( ! empty( $params['orgname'] ) && $params['orgname'] === $orgRow->orgname ) {
            $this->_form->getElement('orgname')->removeValidator('Db_NoRecordExists');
        }

    }

}