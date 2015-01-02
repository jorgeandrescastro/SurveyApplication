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
	    $request = $this->getRequest();	    
	    $internalUserId = $request->getParam('iid');
	    
	    if(is_null($internalUserId) || empty($internalUserId)){
	        //TODO: Uncomment
// 	        $this->_user   = $this->getUserFromFacebook();
	        
	        //TODO: Delete test code
	        $mapper = new Application_Model_UserMapper();
	        $this->_user = $mapper->find(1);
	    } else {
	        $mapper = new Application_Model_UserMapper();
	        $this->_user = $mapper->find($internalUserId);
	    }
	    
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
        
        $form 				 = new Application_Form_FactoryForm(null, $currentBlock, $this->_user->getId());
        
        $request = $this->getRequest();
        if($request->isPost()) {
            if($form->isValid($this->_request->getPost())) {

                //Persist the User Data
                $this->persistUserData($form->getValues());

                $currentBlock = $this->_survey->getNextBlock($this->_user->getCurrentBlock());
                if(!empty($currentBlock)) {
                    
                    $this->_user->setCurrentBlock($currentBlock->getId());
                    $mapper = new Application_Model_UserMapper();
                    
                    $mapper->save($this->_user);
                    
                    $mapper              = new Application_Model_QuestionMapper();
                    $questions           = $mapper->fetchQuestionsFromBlock($currentBlock);
                    $currentBlock->setQuestions($questions);
                    $form 				 = new Application_Form_FactoryForm(null, $currentBlock, $this->_user->getId());
                    
                }                 
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
    
    /**
     * Gets the user information from Facebook
     * @return Application_Model_User
     */
    private function getUserFromFacebook()
    {
    	$facebookConnection = new Application_Model_FB();
    	$facebookUserInformation = $facebookConnection->getProfileInformation();
    	
        $userMapper = new Application_Model_UserMapper();
        $user = $userMapper->findByFacebookId($facebookUserInformation['id']);
        
        if(empty($user)) {
            $user = new Application_Model_User($facebookUserInformation['id'], $facebookUserInformation['name']);
        } 
            	
    	$userMapper->save($user);

        return $user;
    }
    
    
    /**
     * Persist the data on the database
     * @param array $data
     * @return boolean
     */
    private function persistUserData($data) 
    {
        if(!isset($data['block']) || !isset($data['user'])) {
            return false;
        }
        
        $blockId = $data['block'];
        $userId = $data['user'];
        
        unset($data['block']);
        unset($data['user']);
        
        $userData = new Application_Model_UserData($userId, $blockId, $data);
        
        $userDataMapper = new Application_Model_UserDataMapper();
        $userDataMapper->save($userData);

        return true;
        
    }
    
}

