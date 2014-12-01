<?php

/**
 * Index Controller 
 * @author Jorge Andrés Castro <jorge.castro@linkstaria.com>
 *
 */
class IndexController extends Zend_Controller_Action
{
	

    public function indexAction()
    {
        $mapper 			 = new Application_Model_SurveyMapper();
        $surveys			 = $mapper->find(1);
        $mapper = new Application_Model_BlockMapper();
        $block = $mapper->find(1); 
        $this->view->surveys = $surveys;
        $this->view->block = $block;
    }
    
   }

