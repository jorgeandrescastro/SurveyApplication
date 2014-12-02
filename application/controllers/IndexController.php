<?php

/**
 * Index Controller 
 * @author Jorge Andrés Castro <jorge.castro@linkstaria.com>
 *
 */
class IndexController extends Zend_Controller_Action
{
	private $_surveyId = 1;

    public function indexAction()
    {
        $mapper 			= new Application_Model_SurveyMapper();
        $survey			    = $mapper->find($this->_surveyId);
        
        $this->view->survey = $survey;
    }
    
    public function viewAction()
    {
    	//TODO: change harcoded id to automatically generated id
    	$currentBlockId = 5;
    	
        $request             = $this->getRequest();
        $surveyId            = $request->getParam('id');
        
        $mapper              = new Application_Model_SurveyMapper();
        $survey              = $mapper->find($surveyId);
        
        $mapper              = new Application_Model_BlockMapper();
        $blocks              = $mapper->fetchBlocksFromSurvey($survey);
        
        $currentBlock        = $mapper->find($currentBlockId);
        
        $mapper              = new Application_Model_QuestionMapper();
        $questions           = $mapper->fetchQuestionsFromBlock($currentBlock);
        $currentBlock->setQuestions($questions);
        
        $form 				 = new Application_Form_FactoryForm(null, $currentBlock);
        
        $this->view->form 	 = $form;
        $this->view->current = $currentBlockId;
        $this->view->block   = $currentBlock;
        $this->view->blocks  = $blocks;
    }
    
}

