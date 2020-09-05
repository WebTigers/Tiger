<?php

class Tiger_Db_Table_Row extends Zend_Db_Table_Row
{

    /**
     * Saves the properties to the database.
     *
     * This performs an intelligent insert/update, and reloads the
     * properties with fresh data from the table on success.
     *
     * @return mixed The primary key value(s), as an associative array if the
     *     key is compound, or a scalar if the key is single-column.
     */
    public function saveRow()
    {

        $now        = new DateTime();
        $timestamp  = $now->format('Y-m-d H:i:s');

        $auth       = Zend_Auth::getInstance();
        $user_id    = ( $auth->getIdentity()->role !== 'guest' )
                        ? $auth->getIdentity()->user_id
                        : GUEST_USER_ID;

        /**
         * If the _cleanData array is empty,
         * this is an INSERT of a new row.
         * Otherwise it is an UPDATE.
         */
        if (empty($this->_cleanData)) {

            $this->create_date    = $timestamp;
            $this->create_user_id = $user_id;
            $this->update_date    = $timestamp;
            $this->update_user_id = $user_id;
            $this->active         = 1;
            $this->deleted        = 0;

            return $this->_doInsert();

        }
        else {

            $this->update_date    = $timestamp;
            $this->update_user_id = $user_id;

            return $this->_doUpdate();

        }

    }

}