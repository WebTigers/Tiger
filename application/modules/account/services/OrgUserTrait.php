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

trait Account_Service_OrgUserTrait
{
    ### Admin Service Functions ###

    /**
     * @param $params
     * @teturn Sets the response model.
     */
    public function getAdminOrgUserSelect2List ( $params ) {

        if ( ! empty( $params['user_id'] ) && Tiger_Utility_Uuid::is_valid( $params['user_id'] ) ) {

            $orgUsersRowset = $this->_orgUserModel->getAdminOrgUserListByUserId( $params['user_id'] );

            $results[] = (object) [
                'id' => '',
                'text' => $this->_translate->translate('LABEL.ADD_NEW_ORG'),
            ];
            foreach ( $orgUsersRowset as $orgUserRow ) {
                $results[] = (object)[
                    'id' => $orgUserRow->org_user_id,
                    'text' => $orgUserRow->orgname . ' | ' . $orgUserRow->company_name,
                    'primary' => $orgUserRow->primary,
                ];
            }

        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    /**
     * @param $params
     * @return Sets the response model.
     */
    public function getOrgUser ( $params )
    {
        if ( ! empty( $params['org_user_id'] ) && Tiger_Utility_Uuid::is_valid( $params['org_user_id'] ) ) {

            $orgUserRow = $this->_orgUserModel->getOrgUserById( $params['org_user_id'] );

            $this->_response->result = 1;
            $this->_response->data = $orgUserRow->toArray();

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.ORG_USER_NOT_FOUND', 'alert' );

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
    public function updateOrgUser ( $params ) {

        $this->_form = new Account_Form_OrgUser();

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
            $orgRow = $this->_persistOrgUser( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $orgUser = (object) $orgRow->toArray();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $orgUser;
            $this->_response->setTextMessage( 'MESSAGE.ORG_USER_SAVED', 'success' );

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
    public function saveOrgUser ( $params ) {

        try {

            $this->_form = new Account_Form_OrgUser();

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
            $orgUserRow = $this->_persistOrgUser( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $orgUserRow;
            $this->_response->setTextMessage( 'MESSAGE.ORG_USER_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'error' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * PersistOrgUser is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the org table. If you
     * pass in a populated org_user_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @return mixed
     * @throws Exception
     */
    protected function _persistOrgUser( $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a org_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['org_user_id'] ) ) {

            $orgUserRow = $this->_orgUserModel->getOrgUserById( $data['org_user_id'] );

            if ( empty($orgUserRow) ) {
                throw new Exception('ERROR.ORG_USER_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $orgUserRow->setFromArray( $data );

            }
            else {

                unset( $data['org_user_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $orgUserRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $orgUserRow = $this->_orgUserModel->createRow( $data );

            /**
             * Update the relevant pieces with new org system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $orgUserRow->org_user_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new org to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this org. In our use case
         * we simply return the entire row object.
         */
        $orgUserRow->saveRow();
        return $orgUserRow;

    }

}