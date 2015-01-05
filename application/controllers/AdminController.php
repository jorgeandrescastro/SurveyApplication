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
        
        $this->view->user = $user;
    }
}