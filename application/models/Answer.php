<?php

/**
 * Class to model the questions' answers
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Answer 
{
     /**
      * Id of the Answer
      * @var int
      */
     protected $_id;
     
     /**
      * Text of the Answer
      * @var string
      */
     protected $_text;
     
    
     
     public function __construct(array $options = null) 
     {
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_Answer
      */
     public function setId($id)
     {
         $this->_id = $id;
         return $this;
     }
     
     /**
      * Getter of the id
      * @return int
      */
     public function getId() 
     {
         return $this->_id;
     }
     
     /**
      * Setter of the Text
      * @param string $text
      * @return Application_Model_Answer
      */
     public function setText($text)
     {
         $this->_text = $text;
         return $this;
     }
     
     /**
      * Getter of the text
      * @return string
      */
     public function getText() 
     {
         return $this->_text;
     }
     
}