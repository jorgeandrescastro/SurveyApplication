<?php

/**
 * Admin Controller
 * @author Jorge Andrés Castro <jorge.castro@linkstaria.com>
 *
 */
class AdminController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('adminLayout');
        
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('authentication/login');
        }
        $this->_userAuth = Zend_Auth::getInstance()->getIdentity();
        
        $stats = Application_Model_Stat::getSurveyStats();
        $this->view->stats = $stats;
    }
    
    public function indexAction()
    {                        
        $userMapper = new Application_Model_UserMapper();
        $users = $userMapper->getAllUsers();
        
        $this->view->users = $users;
    }
    
    public function viewAction()
    {
        $request = $this->getRequest();
        $internalUserId = $request->getParam('iid');
        
        $userMapper = new Application_Model_UserMapper();
        $user = $userMapper->find($internalUserId);
        
        $surveyMapper = new Application_Model_SurveyMapper();
        $survey = $surveyMapper->find(Application_Model_Survey::$DEFAULT_SURVEY);
        
        $blockMapper = new Application_Model_BlockMapper();
        $blocks = $blockMapper->fetchBlocksFromSurvey($survey);
        
        $questionMapper = new Application_Model_QuestionMapper();
        foreach ($blocks as $block) {
            $questions = $questionMapper->fetchQuestionsFromBlock($block);
            $block->setQuestions($questions);
        }
        $survey->setBlocks($blocks);
        
        $userDataMapper = new Application_Model_UserDataMapper();
        $userData = $userDataMapper->getDataFromUser($user);
        
        $this->view->user = $user;
        $this->view->survey = $survey;
        $this->view->userData = $userData;
    }
}