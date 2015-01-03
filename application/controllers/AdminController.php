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
        
        /* Initialize action controller here */
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('authentication/login');
        }
        $this->_userAuth = Zend_Auth::getInstance()->getIdentity();
    }
    
    public function indexAction()
    {        
    }
}