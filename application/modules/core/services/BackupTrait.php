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

trait Core_Service_BackupTrait
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
    public function getAdminBackupDataTable ( $post ) {

        /** DataTables needs a filtered count for pagination */
        $recordsTotalRowset = $this->getAdminBackupList();
        $recordsFilteredRowset = $recordsTotalRowset;

        $recordsOut = [];
        foreach ( $recordsFilteredRowset as $recordRow ) {

            $record = (object) $recordRow;
            $record->DT_RowId = $record->filename;
            $record->controls = $this->_getBackupActions( $record );
            $recordsOut[] = $record;

        }

        $headers = $this->_utility->getTranslation([
            'DT.FILENAME',
            'DT.FILESIZE',
            'DT.FILEDATE',
            'DT.FILETIME',
            'DT.FILEPATH',
            'DT.ACTIONS',
        ]);

        /** Set the pre-formatted array for datatables */
        $this->_response = new Core_Model_ResponseObjectDT([
            'draw'              => 1,
            'recordsTotal'      => count( $recordsTotalRowset ),
            'recordsFiltered'   => count( $recordsTotalRowset ),
            'data'              => $recordsOut,
            'i18n'              => $headers,
        ]);

    }

    /**
     * getAdminBackupList returns an array of backup files.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of files
     */
    public function getAdminBackupList (  )
    {

        $files = $this->getBackupFiles();

        $fileArray = [];
        foreach ( $files as $file ) {

            $pathInfo = pathinfo( $file );

            $fileArray[] = (object) [
                'filesize' => filesize( $file ),
                'filename' => $pathInfo['basename'],
                'filepath' => $pathInfo['dirname'],
                'filetime' => fileatime( $file ),
                'filedate' => date('Y-m-d H:i:s', fileatime( $file ) )
            ];
        }

        // pr( $fileArray );

        return  $fileArray;

    }

    public function getBackupFiles ()
    {

        return glob('/var/www/tiger-backup/*.sql.gz');

    }

    protected function _getBackupActions ( $file ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $file->filename,                             // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fas fa-window-restore restore',          // The class for the icon or button.
            'title'     => $this->_translate->_('DT.RESTORE_DB'),       // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.RESTORE_DB'),       // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $file->filename,
            'value'     => '',
            'class'     => 'fa fas fa-trash delete',
            'title'     => $this->_translate->_('DT.DELETE_FILE'),
            'label'     => $this->_translate->_('DT.DELETE_FILE'),
        ];

        return $actions;

    }

    public function deleteBackup ( $params ) {

        $file = '/var/www/tiger-backup/' . $params['filename'];

        try {

            if ( file_exists( $file ) ) {

                unlink( $file );

                $this->_response->result = 1;
                $this->_response->setTextMessage('MESSAGE.BACKUP_REMOVE_SUCCESS', 'success');

            } else {

                $this->_response->result = 0;
                $this->_response->setTextMessage('MESSAGE.BACKUP_REMOVE_ERROR', 'error');

            }

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error');

        }

    }

}