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

class Doc_Model_Doc extends Zend_Db_Table_Abstract
{
    protected $_name        = 'doc';
    protected $_primary     = 'doc_id';
    protected $_rowClass    = 'Tiger_Db_Table_Row';
    
    /**
     * @param $doc_id
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function getDocById($doc_id)
    {
        $sql = $this->
        select()->
        where('doc_id = ?', $doc_id);
        
        return $this->fetchRow($sql);
    }
    
    /**
     * Returns an array list of docs
     *
     * @return Zend Rowset of docs
     */
    public function getDocList()
    {
        
        $sql = $this->
                select()->
                    order('title ASC');
        
        return $this->fetchAll($sql);
    }

    /**
     * Searches and returns a list of roles based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getDocSearchList($search, $offset = 0, $limit = 0, $orderby = '')
    {
        $sql = $this->select()->

        where('( title LIKE ?', "%$search%")->
        orWhere('desc LIKE ?', "%$search%")->
            
        order($orderby)->
        limit($limit, $offset);

        return $this->fetchAll($sql);
    }

    public function getDocSelectList()
    {

        $rowset = $this->getDocList();

        $docOut = [];
        foreach ($rowset as $row) {
            $docOut[ $row->id ] = Zend_Registry::get('Zend_Translate')->
            translate(strtoupper('TITLE.' . $row->title));
        }

        return $docOut;
    }

    public function getDocDBConfigs()
    {

        $rowset = $this->getDocList();
        $rows = [];
        foreach ($rowset as $row) {
            $rows[ $row->doc_id ] = $row->toArray();
        }
        return new Zend_Config($rows, true);
    }
    
    /**
     * Searches and returns a list of roles based on various searchable fields. Note
     * that admin searches are unconcerned with whether or not a record is active or deleted.
     *
     * These "SearchList" type functions are typically used exclusively by DataTables.
     *
     * @param string $search
     * @param integer $offset
     * @param integer $limit
     * @return array of object of category
     */
    public function getAdminDocSearchList($search, $offset = 0, $limit = 0, $orderby = '')
    {
        $sql = $this->select()
            ->from(['d' => 'doc'], ['*', "(select CONCAT('ID: ', dd.doc_id, '<br/>Title: ', dd.title) as parent_id from doc as dd where d.parent_id=dd.doc_id) as parent_id"])
            ->order($orderby)
            ->limit($limit, $offset);

        //echo $sql->__toString();exit;

        return $this->fetchAll($sql);
    }
    
    /**
     * Returns an array list of doc tree
     *
     * @return Zend Rowset of docs
     */
    public function getDocTree($parent_id = null)
    {
        
        $resultSet = [];
        
        $sql = $this
            ->select()
            ->order('title ASC');
        if ($parent_id == null) {
            $sql->where('parent_id is NULL OR parent_id = 0');
        } else {
            $sql->where('parent_id = ?', $parent_id);
        }
        
        $rows = $this->fetchAll($sql);
        
        foreach ($rows->toArray() as $i => $row) {
            $row['children'] = $this->getDocTree($row['doc_id']);
            
            $resultSet[$i] = $row;
        }
        
        return $resultSet;
    }
    
    /**
     * Creates a string of tree with separators
     *
     * @param integer|null $parent_id
     * @param integer @level
     * @return string
     */
    private function _getDocTreeForSelectElement($parent_id = null, $level = 0)
    {
        $select = null;
        
        $sql = $this
            ->select()
            ->order('title ASC');
        if ($parent_id == null) {
            $sql->where('parent_id is NULL OR parent_id = 0');
        } else {
            $sql->where('parent_id = ?', $parent_id);
        }
        
        $rows = $this->fetchAll($sql);
        
        foreach ($rows->toArray() as $row) {
            $select .= $row['doc_id'] . '#/#' . str_repeat('- - ', $level) . ' ' . $row['title'] . '\n';
            $select .= $this->_getDocTreeForSelectElement($row['doc_id'], $level + 1);
        }
        
        return $select;
    }
    
    /**
     * Create a list of doc tree in array for output
     *
     * @param integer|null $parent_id
     * @param integer @level
     * @return array
     */
    public function getDocTreeForSelectElement($parent_id = null, $level = 0)
    {
        $treeString = $this->_getDocTreeForSelectElement($parent_id, $level);

        $returnTree = [];
        if ( ! empty( $treeString ) ) {

            $tree = explode('\n', $treeString);

            foreach ($tree as $row) {

                list($id, $string) = explode('#/#', $row);

                if (!empty($id)) {
                    $returnTree[$id] = $string;
                }

            }

            array_unshift($returnTree, '      ');

        }

        return $returnTree;

    }

}
