<?php

/**
 * Mapper for the block question
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_QuestionMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for Block
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_Question';
    
    /**
     * Finds a Question
     * @param int $id
     * @return void|Application_Model_Question
     */
    public function find($id) 
    {
        $result = $this->getDbTable($this->_dbTableClassName)->find($id);  
        
        if(0 == count($result))
        {
        	return;
        }
        
        $row = $result->current();
        
        $question = new Application_Model_Question();
        
        $question->setId($row->id)
                 ->setText($row->name)
                 ->setType($row->type);
        
        return $question;
    }
    
}