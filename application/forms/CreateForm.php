<?php
/**
 * Class to render the create game form
 * @author Jorge Andrés Castro <jorge.castro@softgames.de>
 *
 */
class Application_Form_CreateForm extends Zend_Form {
	
	public function __construct($options = null, $categories){
		parent::__construct($options);
		
		$this->setName('create');
		$this->setMethod('POST');
		$this->setAttrib('enctype', 'multipart/form-data');
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl() . '/index/view');
		
		$nameField = new Zend_Form_Element_Text('name');
		$nameField->setLabel('Name of the game *: ')
				  ->setRequired(true)
				  ->addErrorMessage('Please, type the name of the game');
		
		$nameField->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td', 'align' => 'center')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
// 		$imageField = new Zend_Form_Element_File('image');
// 		$imageField->setLabel("Choose the image of the game *: ")
// 				  ->setRequired(true)
// 				  ->setDestination(APPLICATION_PATH . '/data')
// 				  ->addErrorMessage('Please, choose the image for the game');
		
// 		$imageField->setDecorators(array(
// 				'File',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$srcField = new Zend_Form_Element_File('src', array('multiple' => 'multiple', 'isArray' => true));
// 		$srcField->setLabel("Source code of the game *: ")
// 				   ->setMaxFileSize(10000000)
// 				   ->setAttrib('enctype', 'multipart/form-data')
// 				   ->setRequired(true)
// 				   ->setDestination(APPLICATION_PATH . '/data')
// 				   ->addErrorMessage('Please, choose the source code of the game')
// 				   ->addValidator('Size', false, 10000000);
		
// 		$srcField->setDecorators(array(
// 				'File',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$altField = new Zend_Form_Element_Text('alt');
// 		$altField->setLabel('Alt text: ');
		
// 		$altField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$string1Field = new Zend_Form_Element_Text('string1');
// 		$string1Field->setLabel('String Text 1: ');
		
// 		$string1Field->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$string2Field = new Zend_Form_Element_Text('string2');
// 		$string2Field->setLabel('String Text 2: ');
		
// 		$string2Field->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$gametypeField = new Zend_Form_Element_Select('gametype');
// 		$gametypeField->setLabel('Game type *: ')		
// 			          ->setMultiOptions(array('free'=>'Free', 'sgds'=>'Sgds'))
// 			          ->setRequired(true);		
		
// 		$gametypeField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$marketField = new Zend_Form_Element_Text('market');
// 		$marketField->setLabel('Market: ');
		
// 		$marketField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$urlField = new Zend_Form_Element_Text('url');
// 		$urlField->setLabel('URL of the game: ');
		
// 		$urlField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		

		
// 		$categoryField = new Zend_Form_Element_Select('category');
// 		$categoryField->setLabel('Game Category *: ')
// 					  ->setMultiOptions($categories)
// 					  ->setRequired(true);
		
// 		$categoryField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$categoriesField = new Zend_Form_Element_Multiselect('categories');
// 		$categoriesField->setLabel('Game Categories *: You can select more than one')
// 						->setMultiOptions($categories)
// 						->setRequired(true)
// 						->addErrorMessage('Please, choose the categories of the game');
		
// 		$categoriesField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
		
// 		$comingsoonField = new Zend_Form_Element_Checkbox("comingsoon");
// 		$comingsoonField->setLabel('Coming Soon: ');
		
// 		$comingsoonField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$onlineField = new Zend_Form_Element_Checkbox("online");
// 		$onlineField->setLabel('Online: ');
		
// 		$onlineField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$headerField = new Zend_Form_Element_Checkbox("header");
// 		$headerField->setLabel('Header: ');
		
// 		$headerField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$startpageField = new Zend_Form_Element_Checkbox("startpage");
// 		$startpageField->setLabel('Startpage: ');
		
// 		$startpageField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$haveHeaderField = new Zend_Form_Element_Checkbox('haveheader');
// 		$haveHeaderField->setLabel('Have Header: ');
		
// 		$haveHeaderField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
// 		$priorityField = new Zend_Form_Element_Text('priority');
// 		$priorityField->setLabel('Priority: ')
// 					  ->setRequired(true)
// 					  ->addErrorMessage('Please, set a priority for the game');;
		
// 		$priorityField->setDecorators(array(
// 				'ViewHelper',
// 				'Description',
// 				'Errors',
// 				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
// 				array('Label', array('tag' => 'td')),
// 				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
// 		));
		
		$submitButton = new Zend_Form_Element_Submit('create');
		$submitButton->setLabel('Create Game');
		
		$submitButton->setDecorators(array(
               'ViewHelper',
               'Description',
               'Errors', 
			   array(array('data'=>'HtmlTag'), array('tag' => 'td','colspan'=>'2','class'=>'center')),
               array(array('row'=>'HtmlTag'),array('tag'=>'tr', 'closeOnly'=>'true'))
       ));

// 		$this->addElements(array($nameField, $imageField, $srcField, $altField, $string1Field, $string2Field,
// 								 $gametypeField, $urlField, $marketField, $categoryField, $categoriesField, $comingsoonField, 
// 								 $onlineField, $headerField, $startpageField, $haveHeaderField, $priorityField, $submitButton));
		
		
		$this->addElements(array($nameField, $submitButton));
		
		
		$this->setDecorators(array(
               'FormElements',
               array(array('data'=>'HtmlTag'),array('tag'=>'table')),
               'Form'
       ));
		
	}
	
}