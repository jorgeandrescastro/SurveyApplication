<?php

/**
 * Mapper for the survey table
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_SurveyMapper extends Application_Model_AbstractMapper
{
	/**
	 * DB table class name for Survey
	 * @var int
	 */
	private $_dbTableClassName = 'Application_Model_DbTable_Survey'; 
    
    /**
     * Finds a survey
     * @param int $id
     * @return void|Application_Model_Survey
     */
    public function find($id) 
    {
        $result = $this->getDbTable($this->_dbTableClassName)->find($id);       
        if(0 == count($result))
        {
        	return;
        }
        
        $row = $result->current();
        
        $survey = new Application_Model_Survey();
        
        $survey->setId($row->id)
               ->setName($row->name)
               ->setDescription($row->description);
        
        return $survey;
    }
     
}