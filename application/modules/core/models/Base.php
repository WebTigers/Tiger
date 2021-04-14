<?php

class Core_Model_Base extends Zend_Db_Table_Abstract {

    public function createNewRow ( Array $data = [] ) {

        /** Creates a new Tiger DB Table Row tied to a DB table's new record. */
        $newRow = $this->createRow( $data );

        $now        = new DateTime();
        $timestamp  = $now->format('Y-m-d H:i:s');

        $auth       = Zend_Auth::getInstance();
        $user_id    = ( $auth->getIdentity()->role !== 'guest' )
            ? $auth->getIdentity()->user_id
            : GUEST_USER_ID;

        $newRow->create_date    = $timestamp;
        $newRow->update_date    = $timestamp;
        $newRow->create_user_id = $user_id;
        $newRow->update_user_id = $user_id;
        $newRow->active         = 1;
        $newRow->deleted        = 0;

        return $newRow;

    }

}
