<?php

/**
 * Factory to create the survey's blocks' forms 
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Form_FactoryForm extends Zend_Form
{
	public function __construct($options = null, Application_Model_Block $block)
	{
		parent::__construct($options);
		
		$this->setName('surveyBlock' . $block->getId() );
		$this->setMethod('POST');
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl() . '/index/view');
		
		$elements = array();
		
		foreach ($block->getQuestions() as $question)
		{
            $field = Application_Form_FactoryForm::createField($question);
			
		    $elements[] = $field;
		}
		
		$submitButton = new Zend_Form_Element_Submit('continue');
		$submitButton->setLabel('Continuar')
		             ->setAttrib('class', 'form-control btn-primary');
		
// 		$submitButton->setDecorators(array(
// 		        'ViewHelper',
// 		        'Description',
// 		        'Errors',
// 		        array(array('data'=>'HtmlTag'), array('tag' => 'td','colspan'=>'2','class'=>'center')),
// 		        array(array('row'=>'HtmlTag'),array('tag'=>'tr', 'closeOnly'=>'true'))
// 		));
        $elements[] = $submitButton;
		
		$this->addElements($elements);
	}
	
	public static function createField(Application_Model_Question $question)
	{
	   switch($question->getType())
	   {
	       case Application_Model_Question::QUESTION_TEXT:
	           $field = new Zend_Form_Element_Text('question_' . $question->getId());
	           $field->setDecorators(array(
	                   'ViewHelper',
	                   'Description',
	                   'Errors',
	                   array(array('data'=>'HtmlTag')),
	                   array('Label', array('tag' => 'div', 'align' => 'left')),
	                   array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'form-group'))
	           ));
	           $field->setAttrib('class', 'form-control');
	       	   break;
	       case Application_Model_Question::QUESTION_SELECT:
	       	   $field = new Zend_Form_Element_Select('question_' . $question->getId());
	       	   $field->setMultiOptions($question->getAnswers());
	       	   $field->setDecorators(array(
	       	           'ViewHelper',
	       	           'Description',
	       	           'Errors',
	       	           array(array('data'=>'HtmlTag')),
	       	           array('Label', array('tag' => 'div', 'align' => 'left')),
	       	           array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'form-group'))
	       	   ));
	       	   $field->setAttrib('class', 'form-control');
	       	   break;
	       case Application_Model_Question::QUESTION_CHECK_BOX:
	           $field = new Zend_Form_Element_MultiCheckbox('question_' . $question->getId());
	           $field->setMultiOptions($question->getAnswers());
	           $field->setDecorators(array(
	                   'ViewHelper',
	                   'Description',
	                   'Errors',
	                   array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'checkbox')),
	                   array('Label', array('tag' => 'div', 'align' => 'left', 'class' => 'checkbox')),
	                   array(array('row'=>'HtmlTag'),array('tag'=>'div'))
	           ));
	       	   break;
	       	case Application_Model_Question::QUESTION_RADIO_OPTION:
	       	       $field = new Zend_Form_Element_Radio('question_' . $question->getId());
	       	       $field->setMultiOptions($question->getAnswers());
	       	       $field->setDecorators(array(
	       	               'ViewHelper',
	       	               'Description',
	       	               'Errors',
	       	               array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'radio')),
	       	               array('Label', array('tag' => 'div', 'align' => 'left', 'class' => 'radio')),
	       	               array(array('row'=>'HtmlTag'),array('tag'=>'div'))
	       	       ));
	       	       break;
	   }   
	   
	   $field->setLabel(utf8_encode($question->getText()))
	         ->setRequired($question->isRequired());

	   return $field; 
	}
}