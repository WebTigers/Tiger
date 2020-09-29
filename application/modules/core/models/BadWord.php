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

/**
 * Class Core_Model_BadWord
 */
class Core_Model_BadWord extends Zend_Db_Table_Abstract
{
    protected $_name    = 'badword';
    protected $_primary = 'badword_id';
    protected $_rowClass = 'Tiger_Db_Table_Row';

    public function init()
    {
    }

    /**
     * @param $badword_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getBadwordById ( $badword_id )
    {
        $sql =  $this->
                select()->
                where('badword_id = ?', $badword_id);
        
        return $this->fetchRow($sql);
        
    }

    /**
     * @param null $locale
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getBadwordListByLocale ( $locale = null )
    {
        /** returns a Zend Rowset that we convert into an array of data */

        $sql =  $this->
                select()->
                from($this, array('text'))->
                where('locale = ?', $locale);
        
        return $this->fetchAll($sql);
        
    }

}
