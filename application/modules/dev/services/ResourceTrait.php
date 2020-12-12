<?php

trait Dev_Service_ResourceTrait
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
    public function getAdminResourcesDataTable ( $post ) {

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

            $headers = $this->_utility->getTranslation([
                'DT.MODULE',
                'DT.RESOURCE_NAME',
                'DT.RESOURCE_DESCRIPTION',
                'DT.RESOURCE',
                'DT.PRIVILEGE',
                'DT.ACTIONS',
                'DT.RESOURCE_ID',
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
     * getAdminResourceSearchList returns a rowset of resources.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminResourceSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_resourceModel->getAdminResourceSearchList( $search, $offset, $limit, $orderby );

    }

    public function getAdminStaticResourcesDataTable ( )
    {
        $records = []; //$this->getResourceConfigsList();

        /** Groom the Config for Datatables response ... */

        $recordsOut = [];
        foreach( $records as $key => $rec ) {

            $record = (object) $rec->toArray();

            $record->resource_id = $key;
            $record->module = explode( '_', $record->resource )[0];

            $recordsOut[] = $record;

        }

        $headers = $this->_utility->getTranslation([
            'DT.MODULE',
            'DT.RESOURCE_NAME',
            'DT.RESOURCE_DESCRIPTION',
            'DT.RESOURCE',
            'DT.PRIVILEGE',
        ]);

        /** Set the pre-formatted array for datatables */
        $this->_response = new Core_Model_ResponseObjectDT([
            'data' => $recordsOut,
            'i18n' => $headers,
        ]);

    }

    public function getResourceConfigsList () {

        // return Zend_Registry::get('Zend_Config')->dev->resources;

    }

    protected function _getResourceActions ( $resource ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $resource->resource_id,                      // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_RESOURCE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $resource->resource_id,
            'value'     => $resource->active,
            'class'     => ( intval($resource->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_RESOURCE'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $resource->resource_id,
            'value'     => $resource->deleted,
            'class'     => ( intval($resource->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_RESOURCE'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

    }

}