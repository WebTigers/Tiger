<?php

class Core_Model_BadWord extends Zend_Db_Table_Abstract
{
    protected $_name    = 'badword';
    protected $_primary = 'badword_id';
    
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
