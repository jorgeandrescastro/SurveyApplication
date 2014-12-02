<?php

/**
 * Mapper for the question's answers
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_AnswerMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for Answer
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_Answer';
    
    /**
     * Fetches all the answers from a question
     * @param Application_Model_Question $question
     * @return array 
     */
    public function fetchAnswersFromQuestion(Application_Model_Question $question)
    {
        $select = $this->getDbTable($this->_dbTableClassName)
                        ->select()->where('question_id = ?', $question->getId());
        
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
        $answers = array();
        
        foreach($resultSet as $row) 
        {    
        	$answer = utf8_encode($row['text']);
            $answers[$answer] = $answer;
        }
        
        return $answers;
    }
    
}