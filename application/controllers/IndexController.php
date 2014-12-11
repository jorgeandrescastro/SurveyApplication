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
        $this->view->user   = $this->_user;
        $this->view->survey = $this->_survey;
    }
    
    public function viewAction()
    {	
        $request = $this->getRequest();
                
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
        
        if($request->isPost()) {
            if($form->isValid($this->_request->getPost())) {
                //TODO: Saving of results
                print_r($form);die();
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
    	$user = new Application_Model_User(12345, "Facebook User 1");
//     	$user = new Application_Model_User(123456, "Facebook User 2");
    	$userMapper = new Application_Model_UserMapper();
    	$userMapper->save($user);
    	
        return $user;
    }
    
}

