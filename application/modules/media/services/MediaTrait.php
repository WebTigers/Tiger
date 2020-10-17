<?php

trait Media_Service_MediaTrait
{
    ### Admin Service Functions ###

    public function getUploaderConfigs ( ) {

        $this->_response->result = 1;
        $this->_response->data = [
            'imageExtensions'   => $this->_getValidExtensions('image'),
            'allowedExtensions' => $this->_getValidExtensions(),
            'imageMaxWidth'     => $this->_config->media->upload->image_max_width,
            'imageMaxHeight'    => $this->_config->media->upload->image_max_height,
            'fileMinFiles'      => $this->_config->media->upload->min_files,
            'fileMaxFiles'      => $this->_config->media->upload->max_files,
            'fileMaxFilesize'   => $this->_config->media->upload->max_filesize,
            'fileMaxTotalsize'  => $this->_config->media->upload->max_totalsize,
            'dictionary'        => $this->getUploaderDictionary(),
        ];

    }

    public function getUploaderDictionary ( )
    {
        return [
            'dictDefaultMessage'            => $this->_translate->_('dictDefaultMessage'),
            'dictFallbackMessage'           => $this->_translate->_('dictFallbackMessage'),
            'dictFallbackText'              => $this->_translate->_('dictFallbackText'),
            'dictFileTooBig'                => $this->_translate->_('dictFileTooBig'),
            'dictInvalidFileType'           => $this->_translate->_('dictInvalidFileType'),
            'dictResponseError'             => $this->_translate->_('dictResponseError'),
            'dictCancelUpload'              => $this->_translate->_('dictCancelUpload'),
            'dictUploadCanceled'            => $this->_translate->_('dictUploadCanceled'),
            'dictCancelUploadConfirmation'  => $this->_translate->_('dictCancelUploadConfirmation'),
            'dictRemoveFile'                => $this->_translate->_('dictRemoveFile'),
            'dictRemoveFileConfirmation'    => $this->_translate->_('dictRemoveFileConfirmation'),
            'dictMaxFilesExceeded'          => $this->_translate->_('dictMaxFilesExceeded'),
            'dictFileSizeUnits'             => $this->_translate->_('dictFileSizeUnits'),
            'dictInvalidImageDimensions'    => $this->_translate->_('dictInvalidImageDimensions'),
        ];
    }

    public function getMedia ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['media_id'] ) ) {

            $mediaRow = $this->_mediaModel->getMediaById( $params['media_id'] );

            if ( ! empty( $mediaRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $mediaRow->toArray();


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

    public function getGallery ( $params )
    {
        /** A generic form to validate search params. */
        $this->_form = new Core_Form_Search();

        if ( $this->_form->isValidPartial( $params ) ) {

            $data = $this->_form->getValidValues( $params );

            $mediaRowset = $this->getMediaSearchList( $data );

            if ( ! empty( $mediaRowset ) ) {

                $this->_response->result = 1;
                $this->_response->data = $mediaRowset->toArray();

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

    /**
     * getMediaSearchList returns a rowset of media.
     *
     * @param array $params
     * @return array of Zend Db Table Rowset
     */
    public function getMediaSearchList ( array $params )
    {
        $search     = ( ! empty( $params['search'] ) ) ? $params['search'] : '';
        $offset     = ( ! empty( $params['offset'] ) ) ? $params['offset'] : '';;
        $limit      = ( ! empty( $params['limit'] ) ) ? $params['limit'] : '';;

        $orderby    = ( ! empty( $params['orderby'] ) ) ? $params['orderby'] : '';
        $orderby   .= ( ! empty( $params['direction'] ) ) ? ' ' . $params['direction'] : '';;

        return $this->_mediaModel->getMediaSearchList( $search, $offset, $limit, $orderby );

    }

    public function upload ( $params ) {

        try {

            /** Validate our params */

            if ( $this->_validateUpload( $params ) === false ) {
                return;
            }

            /**
             * We abstract where files are sent via a default storage driver. This
             * can be set as a default or selected via a UI passed param.
             */
            $storageClass = ( ! empty( $params['storageType'] ) )
                ? 'Media_Model_' . $params['storageType']
                : Zend_Registry::get('Zend_Config')->media->default_storage_model;

            $storage = new $storageClass;

            /** Move the file to permanent storage. */
            $result = $storage->moveFileToStorage($params);

            /**
             * If successful, log where the files lives in the database. $result will be
             * a string if there is an error.
             */

            if ( is_array( $result ) ) {

                $mediaRow = $this->saveMedia( $result );

                $this->_response->result = 1;
                $this->_response->data = ( $mediaRow instanceof Zend_Db_Table_Row_Abstract ) ? $mediaRow->toArray() : null;
                $this->_response->setTextMessage( 'MESSAGE.MEDIA_SAVED', 'success' );

            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage( $result , 'alert' );

            }

        }
        catch ( Exception | Error $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.MEDIA_ERROR_SAVING', 'error' );

            pr( $e->getMessage() );

        }

    }

    ### Upload Validation ###

    /**
     * @return array
     */
    protected function _getValidExtensions ( $type = null ) {

        $out = [];
        foreach( $this->_config->media->allowed as $types => $extensions ) {
            if ( ! empty($type) && $types !== $type ) { continue; }
            foreach( $extensions as $ext => $mime_type ) {
                $out[] = $ext;
            }
        }
        return $out;

    }

    /**
     * @param $params
     * @return bool
     * @throws Zend_File_Transfer_Exception
     */
    protected function _validateUpload ( $params ) {

        $uploader = new Zend_File_Transfer_Adapter_Http([
            'detectInfos' => false,     // This tells the transfer adapter not to overwrite our $_FILES superglobal.
        ]);

        $uploader
            ->addValidator('Size',      false, $this->_config->media->upload->max_filesize)    // Set single file size in bytes
            ->addValidator('FilesSize', false, $this->_config->media->upload->max_totalsize)   // Set aggregate file uploads size in bytes
            ->addValidator('Extension', false, $this->_getValidExtensions() )                  // Validate file extension
            ->addValidator('Count',     false, [
                'min' => $this->_config->media->upload->min_files,  // Set the minimum number of files that can be uploaded
                'max' => $this->_config->media->upload->max_files   // Set the maximum number of files that can be uploaded
            ]);

        /** If this is an image file add the imagesize validator ... */
        if ( explode('/', $_FILES['file']['type'] )[0] === self::MIME_IMAGE ) {

            $uploader
            ->addValidator('ImageSize', false, [
                'maxwidth' => $this->_config->media->upload->image_max_width,
                'maxheight' => $this->_config->media->upload->image_max_height
            ]);

        }

        /** Instantiate ClamAV and make sure the virus scanner is up and running ... */
        if ( boolval( $this->_config->media->upload->av_scan ) === true ) {

            $clamAV = new Tiger_Validate_ClamAV();
            /** Ping the service to make sure it's running ... */
            if ( $clamAV->ping() === true ) {
                $uploader->addValidator($clamAV, false);    // Virus Scan the file on upload
            }

        }

        if ( ! $uploader->isValid() ) {

            $this->_response->result = 0;
            foreach( $uploader->getErrors() as $error ){
                $this->_response->setTextMessage( $error , 'alert' );
            }

        }
        else {

            return true;

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
    public function updateMedia ( $params ) {

        $this->_form = new Media_Form_Media();

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
             * Since we're not really doing anything with the media being persisted
             * we don't need the $mediaRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $mediaRow = $this->_persistMedia( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $mediaRow->toArray();
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
    public function saveMedia ( $params ) {

        try {

            $this->_form = new Media_Form_Media();

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
             * Since we're not really doing anything with the media being persisted
             * we don't need the $mediaRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $mediaRow = $this->_persistMedia( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            return $mediaRow;

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

            pr( $e->getMessage() );

        }
        catch ( Error $e ) {

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
     * PersistMedia is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated media_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @throws Exception
     * @return mixed
     */
    protected function _persistMedia( array $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a media_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['media_id'] ) ) {

            $mediaRow = $this->_mediaModel->getMediaById( $data['media_id'] );

            if ( empty($mediaRow) ) {
                throw new Exception('ERROR.MEDIA_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $mediaRow->setFromArray( $data );

            }
            else {

                unset( $data['media_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $mediaRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $mediaRow = $this->_mediaModel->createRow( $data );

            /** Update the relevant pieces with new media data. */
            $mediaRow->media_id = Tiger_Utility_Uuid::v1();
            $mediaRow->upload_ip = $_SERVER['REMOTE_ADDR'];
            $mediaRow->active = 1;

        }

        /**
         * Now we can save the new media to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $mediaRow->saveRow();

        return $mediaRow;

    }

}