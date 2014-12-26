<?php

/**
 * Index Controller 
 * @author Jorge Andrés Castro <jorge.castro@linkstaria.com>
 *
 */
class IndexController extends Zend_Controller_Action
{
	/**
	 * @var Application_Model_Survey
	 */
	private $_survey;
	
	/**
	 * @var Application_Model_User
	 */
	private $_user;
	
	public function init()
	{
	    $this->_user   = $this->getUserFromFacebook();
	    
	    $mapper        = new Application_Model_SurveyMapper();
	    $this->_survey = $mapper->find(1);
	}

    public function indexAction()
    {		        
        $test = new Application_Model_FB();
        $test->getProfileInformation();        
        $this->view->user   = $this->_user;
        $this->view->survey = $this->_survey;
    }
    
    public function viewAction()
    {	
        if ($this->_user->hasFinishedSurvey()) {
            $this->_redirect('index/thankyou');
        }
        
        $mapper = new Application_Model_BlockMapper();
        $blocks = $mapper->fetchBlocksFromSurvey($this->_survey);
        $this->_survey->setBlocks($blocks);
        
        if(0 == $this->_user->getCurrentBlock()) {
            $firstBlock = $this->_survey->getInitialBlock();
            $this->_user->setCurrentBlock($firstBlock->getId());
        }
        
        $currentBlock        = $mapper->find($this->_user->getCurrentBlock());
        
        $mapper              = new Application_Model_QuestionMapper();
        $questions           = $mapper->fetchQuestionsFromBlock($currentBlock);
        $currentBlock->setQuestions($questions);
        
        $form 				 = new Application_Form_FactoryForm(null, $currentBlock);
        
        $request = $this->getRequest();
        if($request->isPost()) {
            if($form->isValid($this->_request->getPost())) {
                
                $currentBlock = $this->_survey->getNextBlock($this->_user->getCurrentBlock());
                if(!empty($currentBlock)) {
                    
                    $this->_user->setCurrentBlock($currentBlock->getId());
                    $mapper = new Application_Model_UserMapper();
                    
                    $mapper->save($this->_user);
                    
                    $mapper              = new Application_Model_QuestionMapper();
                    $questions           = $mapper->fetchQuestionsFromBlock($currentBlock);
                    $currentBlock->setQuestions($questions);
                    $form 				 = new Application_Form_FactoryForm(null, $currentBlock);
                    
                }
                
                //TODO: Saving of results
            }
        }
        
        $this->view->form 	 = $form;
        $this->view->current = $this->_user->getCurrentBlock();
        $this->view->block   = $currentBlock;
        $this->view->blocks  = $blocks;
    }
    
    public function thankyouAction()
    {
    }
    
    private function getUserFromFacebook()
    {
    	//TODO: Get facebook information
    	$facebook_id = 312345;
        $userMapper = new Application_Model_UserMapper();
        $user = $userMapper->findByFacebookId($facebook_id);
        
        if(empty($user)) {
            $user = new Application_Model_User($facebook_id, "Facebook User 3");
        } 
            	
    	$userMapper->save($user);
    	
        return $user;
    }
    
}

