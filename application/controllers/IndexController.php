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
	
	/**
	 * Mappers 
	 * @var array
	 */
	private $_mappers;
	
	public function init()
	{
	    $this->_mappers = Application_Model_MapperFactory::getMappers();
	    
	    $request = $this->getRequest();	    
	    $internalUserId = $request->getParam('iid');
	    
	    if(is_null($internalUserId) || empty($internalUserId)){
	        //TODO: Uncomment
	        $this->_user   = $this->getUserFromFacebook();
	        
	        //TODO: Delete test code
// 	        $this->_user = $this->_mappers['USER']->find(7);
	    } else {
	        $this->_user = $this->_mappers['USER']->find($internalUserId);
	    }
	    
	    $this->_survey = $this->_mappers['SURVEY']->find(Application_Model_Survey::$DEFAULT_SURVEY);
	}

    public function indexAction()
    {		   
        if ($this->_user->hasFinishedSurvey()) {
            $this->_redirect('index/thankyou');
        }
        
        $blocks = $this->_mappers['BLOCK']->fetchBlocksFromSurvey($this->_survey);
        $this->_survey->setBlocks($blocks);
        
        if(0 == $this->_user->getCurrentBlock()) {
            $firstBlock = $this->_survey->getInitialBlock();            
            $this->_user->setCurrentBlock($firstBlock->getId());
            $this->_mappers['USER']->save($this->_user);
        }
        
        $this->view->user   = $this->_user;
        $this->view->survey = $this->_survey;
    }
    
    public function viewAction()
    {	        
        $blocks = $this->_mappers['BLOCK']->fetchBlocksFromSurvey($this->_survey);
        $this->_survey->setBlocks($blocks);
        
        $currentBlock        = $this->_mappers['BLOCK']->find($this->_user->getCurrentBlock());
        
        $questions           = $this->_mappers['QUESTION']->fetchQuestionsFromBlock($currentBlock);
        $currentBlock->setQuestions($questions);
        
        $form 				 = new Application_Form_FactoryForm(null, $currentBlock, $this->_user);
        
        $request = $this->getRequest();
        if($request->isPost()) {
            if($form->isValid($this->_request->getPost())) {

                //Persist the User Data
                $this->persistUserData($form->getValues());

                $currentBlock = $this->_survey->getNextBlock($this->_user->getCurrentBlock());

                if(!empty($currentBlock)) {
                    
                    $this->_user->setCurrentBlock($currentBlock->getId());
                    
                    $this->_mappers['USER']->save($this->_user);
                    
                    $questions           = $this->_mappers['QUESTION']->fetchQuestionsFromBlock($currentBlock);
                    $currentBlock->setQuestions($questions);
                    $form 				 = new Application_Form_FactoryForm(null, $currentBlock, $this->_user);
                    
                } else {
                    $this->_user->setFinishDate(time());
                    $this->_mappers['USER']->save($this->_user);
                    $this->_redirect('index/thankyou');
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
        print_r($facebookUserInformation);die();
        $user = $this->_mappers['USER']->findByFacebookId($facebookUserInformation[0]);
        
        if(empty($user)) {
            $user = new Application_Model_User($facebookUserInformation[0], $facebookUserInformation[1]);
        } 
        
        $user->setFbdata($facebookUserInformation);
            	
    	$this->_mappers['USER']->save($user);

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
        
        $this->_mappers['USERDATA']->save($userData);

        return true;
        
    }
    
}

