<?php

/**
 * Form for the login 
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Form_LoginForm extends Zend_Form 
{
	
	public function __construct($options = null){
		parent::__construct($options);
		
		$this->setName('login');
		
		$usernameField = new Zend_Form_Element_Text('username');
		$usernameField->setLabel('Nombre de Usuario:')
					  ->setRequired(true)
					  ->setErrorMessages(array('isEmpty'=>'Por favor ingrese su Nombre de usuario'))
					  ->setDecorators(array(
    					  'ViewHelper',
    					  'Description',
    					  'Errors',
    					  array(array('data'=>'HtmlTag')),
    					  array('Label', array('tag' => 'div', 'align' => 'left')),
    					  array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'form-group'))
					  ))
					 ->setAttrib('class', 'form-control');
		
		
		$passwordField = new Zend_Form_Element_Password('password');
		$passwordField->setLabel('Contraseña:')
					   ->setRequired(true)
					   ->setErrorMessages(array('isEmpty'=>'Por favor ingrese su contraseña'))
					   ->setDecorators(array(
					           'ViewHelper',
					           'Description',
					           'Errors',
					           array(array('data'=>'HtmlTag')),
					           array('Label', array('tag' => 'div', 'align' => 'left')),
					           array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'form-group'))
					   ))
					   ->setAttrib('class', 'form-control');
		
		$submitButton = new Zend_Form_Element_Submit('login');
		$submitButton->setLabel('Ingresar')
		             ->setAttrib('class', 'form-control btn-primary');;
		$this->addElements(array($usernameField, $passwordField, $submitButton));
		$this->setMethod('POST');
		
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl() . '/authentication/login');
	}
	
}