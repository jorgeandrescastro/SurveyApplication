<?php

/**
 * Factory to create the survey's blocks' forms 
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Form_FactoryForm extends Zend_Form
{
	public function __construct($options = null, Application_Model_Block $block, Application_Model_User $user)
	{
		parent::__construct($options);
		
		$this->setName('surveyBlock_' . $block->getId());
		$this->setMethod('POST');
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl() . "/index/view/iid/" . $user->getId());
		
		$elements = array();
		
		$field = new Zend_Form_Element_Hidden('block');
		$field->setValue($block->getId());
		$elements[] = $field;
		
		$field = new Zend_Form_Element_Hidden('user');
		$field->setValue($user->getId());
		$elements[] = $field;
		
		$prepopulatedFields = $user->getFbdata();
		
		foreach ($block->getQuestions() as $question)
		{
            $field = Application_Form_FactoryForm::createField($question, $prepopulatedFields);
			
		    $elements[] = $field;
		}
		
		$submitButton = new Zend_Form_Element_Submit('continue');
		$submitButton->setLabel('Continuar')
		             ->setAttrib('class', 'form-control btn-primary');

        $elements[] = $submitButton;
		
		$this->addElements($elements);
	}
	
	public static function createField(Application_Model_Question $question, $prepopulatedFields)
	{
		 $addClass = '';
		 if($question->isHidden()) {
		 	 $addClass = 'hidden dependent' . $question->getDependsOf();
		 }

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
	                   array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => "form-group $addClass"))
	           ));
	           $field->setAttrib('class', 'form-control');
	           
	       	   break;
	       case Application_Model_Question::QUESTION_SELECT:
	       		 $answers = $question->getAnswers();
	       		 array_unshift($answers, array('' => ''));
	       	   $field = new Zend_Form_Element_Select('question_' . $question->getId());
	       	   $field->setMultiOptions($answers);
	       	   $field->setDecorators(array(
	       	           'ViewHelper',
	       	           'Description',
	       	           'Errors',
	       	           array(array('data'=>'HtmlTag')),
	       	           array('Label', array('tag' => 'div', 'align' => 'left')),
	       	           array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => "form-group $addClass"))
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
	                   array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => "$addClass"))
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
	       	               array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => "$addClass"))
	       	       ));
	       	       break;
          case Application_Model_Question::QUESTION_TEXT_AREA:
                 $field = new Zend_Form_Element_Textarea('question_' . $question->getId());
                 $field->setAttrib('cols', 50)
                       ->setAttrib('rows', 3);
                 $field->setDecorators(array(
                         'ViewHelper',
                         'Description',
                         'Errors',
                         array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'radio')),
                         array('Label', array('tag' => 'div', 'align' => 'left', 'class' => 'radio')),
                         array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => "$addClass"))
                 ));
                 break;
	   }   
	   
	   if(isset($prepopulatedFields[$question->getId()])) {
	       $field->setValue($prepopulatedFields[$question->getId()]);
	   }

	   if($question->getDescription() != '') {
	   		$field->setAttrib('data-toggle', "tooltip");
	   		$field->setAttrib('data-placement', "top");
	   		$field->setAttrib('title', $question->getDescription());
	   }
	   
	   $field->setLabel($question->getText())
	         ->setRequired($question->isRequired())
	         ->setErrorMessages(array('isEmpty'=>'Este campo es obligatorio'));

      if($question->isNumeric()) {
          $field->addValidator('Between', true, array('min' => $question->getMin(), 'max' => $question->getMax()))
                ->setErrorMessages(array('Between'=>'El valor debe estar entre ' .
                                                     $question->getMin() . ' y ' . $question->getMax()));
          $field->setAttrib('numeric', "numeric");
      }	   

	   return $field; 
	}
}