<?php

/**
 * Authentication Controller
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('adminLayout');
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
    	if(Zend_Auth::getInstance()->hasIdentity()) {
    		$this->_redirect('admin/index');
    	}
    	
    	$request = $this->getRequest();
    	$form = new Application_Form_LoginForm();
    	
    	if($request->isPost()) {
    		if($form->isValid($this->_request->getPost())) {
    			
    			$authAdapter = $this->getAuthAdapter();
    			 
    			$username = $form->getValue('username');
    			$password = $form->getValue('password');
    			 
    			$authAdapter->setIdentity($username)
    			            ->setCredential($password);
    			 
    			$auth = Zend_Auth::getInstance();
    			$result = $auth->authenticate($authAdapter);
    			 
    			if($result->isValid()) {
    				$userIdentity =  $authAdapter->getResultRowObject();
    				 
    				$authStorage = $auth->getStorage();
    				$authStorage->write($userIdentity);
    				 
    				$this->_redirect('admin/index');
    			} else {
    				$this->view->errorMessage = 'Credenciales incorrectas';
    			}    			
    		}	
    	}
    	
    	$this->view->form = $form;
       
    }

    public function logoutAction()
    {
       Zend_Auth::getInstance()->clearIdentity();
       $this->_redirect('authentication/login');
    }

	/**
	 * Function to get the Authentication Adapter
	 * @return Zend_Auth_Adapter_DbTable
	 */
	private function getAuthAdapter() 
	{
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		
		$authAdapter->setTableName('admin_users')
					->setIdentityColumn('username')
					->setCredentialColumn('password')
					->setCredentialTreatment('MD5(?)');
		
		return $authAdapter;
	}
}




