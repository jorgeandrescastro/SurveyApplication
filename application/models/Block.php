<?php

/**
 * Class to model the Survey's blocks
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Block 
{
     /**
      * Id of the block
      * @var int
      */
     protected $_id;
     
     /**
      * Name of the block
      * @var string
      */
     protected $_name;
     
     /**
      * Set of questions of the block
      * @var array
      */
     protected $_questions;
     
     public function __construct(array $options = null) 
     {
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_Block
      */
     public function setId($id)
     {
         $this->_id = $id;
         return $this;
     }
     
     /**
      * Getter of the id
      * @return number
      */
     public function getId() 
     {
         return $this->_id;
     }
     
     /**
      * Setter of the Name
      * @param string $name
      * @return Application_Model_Block
      */
     public function setName($name)
     {
         $this->_name = $name;
         return $this;
     }
     
     /**
      * Getter of the name
      * @return string
      */
     public function getName() 
     {
         return utf8_encode($this->_name);
     }
     
     /**
      * Setter of the questions
      * @param array $questions
      * @return Application_Model_Block
      */
     public function setQuestions($questions)
     {
         $this->_questions = $questions;
         return $this;
     }
     
     /**
      * Getter of the questions
      * @return multitype:
      */
     public function getQuestions() 
     {
         return $this->_questions;
     }
     
     
     
     
}