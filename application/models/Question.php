<?php

/**
 * Class to model the survey's questions
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Question 
{
	
    /**
     * Constants for the question types
     */
    const QUESTION_TEXT = 1;
    const QUESTION_RADIO_OPTION = 2;
    const QUESTION_CHECK_BOX = 3;
    const QUESTION_SELECT = 4;
    
    
    /**
     * Id of the question
     * @var int
     */
    protected $_id;
    
    /**
     * Text of the question
     * @var string
     */
    protected $_text;
    
    /**
     * Type of question
     * @var int
     */
    protected $_type;
    
    /**
     * Set of possible answers 
     * @var arr
     */
    protected $_answers;
    
    /**
     * Is the question required?
     * @var int
     */
    protected $_required;
    
    public function __construct(array $options = null)
    {
    }
    
    /**
     * Setter for the id
     * @param int $id
     * @return Application_Model_Question
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }
    
    /**
     * Getter for the id
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /**
     * Setter for the text
     * @param string $text
     * @return Application_Model_Question
     */
    public function setText($text)
    {
        $this->_text = $text;
        return $this;
    }
    
    /**
     * Getter for the text
     * @return string
     */
    public function getText()
    {
        return $this->_text;
    }
    
    /**
     * Setter for the type
     * @param int $type
     * @return Application_Model_Question
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }
    
    /**
     * Getter for the type
     * @return int
     */
    public function getType()
    {
        return $this->_type;
    }
    
    /**
     * Setter for the answers
     * @param array $answers
     * @return Application_Model_Question
     */
    public function setAnswers($answers)
    {
        $this->_answers = $answers;
        return $this;
    }
    
    /**
     * Getter for the answers
     * @return array
     */
    public function getAnswers()
    {
        return $this->_answers;
    }
    
    /**
     * Setter for required
     * @param int $required
     * @return Application_Model_Question
     */
    public function setRequired($required)
    {
        $this->_required = $required;
        return $this;
    }
    
    /**
     * Returns if the question is required
     * @return boolean
     */
    public function isRequired()
    {
        return (1 == $this->_required);
    }
}