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
                 ->setText($row->text)
                 ->setType($row->type)
                 ->setRequired($row->required);
        
        return $question;
    }
    
    /**
     * Fetches all the questions from a block
     * @param Application_Model_Block $block
     * @return array:Application_Model_Question 
     */
    public function fetchQuestionsFromBlock(Application_Model_Block $block)
    {
        $select = $this->getDbTable($this->_dbTableClassName)
                        ->select()->where('block_id = ?', $block->getId());
        
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
        $questions = array();
        
        foreach($resultSet as $row) {
            $question = new Application_Model_Question();
            $question->setId($row['id'])
                     ->setText($row['text'])
                     ->setType($row['type'])
                     ->setRequired($row['required']);
            
            $answers = $this->getAnswersFromQuestion($question);
             
            $question->setAnswers($answers);
            
            $questions[$row['id']] = $question;
        }
        
        return $questions;
    }
    
    private function getAnswersFromQuestion(Application_Model_Question $question)
    {
        $mapper = new Application_Model_AnswerMapper();
        $answers = $mapper->fetchAnswersFromQuestion($question);
        return $answers;
    }
    
}