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
    
}