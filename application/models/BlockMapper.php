<?php

/**
 * Mapper for the block table
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_BlockMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for Block
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_Block';
    
    /**
     * Finds a Block
     * @param int $id
     * @return void|Application_Model_Block
     */
    public function find($id) 
    {
        $result = $this->getDbTable($this->_dbTableClassName)->find($id);  
        
        if(0 == count($result))
        {
        	return;
        }
        
        $row = $result->current();
        
        $block = new Application_Model_Block();
        
        $block->setId($row->id)
        ->setName($row->name);
        
        return $block;
    }
    
    /**
     * Fetches all the blocks from a survey
     * @param Application_Model_Survey $survey
     * @return array:Application_Model_Block 
     */
    public function fetchBlocksFromSurvey(Application_Model_Survey $survey)
    {
        $select = $this->getDbTable($this->_dbTableClassName)
                       ->select()->where('survey_id = ?', $survey->getId());
        
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
        $blocks = array();
        
        foreach($resultSet as $row) {
            $block = new Application_Model_Block();
            $block->setId($row['id'])
                  ->setName($row['name']);
            	
            $blocks[$row['id']] = $block;
        }
        
        return $blocks;
    }
    
}