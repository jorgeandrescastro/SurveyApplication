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
    
    /**
     * Is the question's answer numeric?
     * @var int
     */
    protected $_numeric;
    
    /**
     * Minimum Value for numeric answers
     * @var int
     */
    protected $_minValue;
    
    /**
     * Maximum Value for numeric answers
     * @var int
     */
    protected $_maxValue;
    
    /**
     * Does the question have dependents?
     * @var bool
     */
    protected $_hasDependent;
    
    /**
     * Question from which depends on
     * @var int
     */
    protected $_dependsOf;
    
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
        return utf8_encode($this->_text);
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
    
    /**
     * Setter for numeric
     * @param int $numeric
     * @return Application_Model_Question
     */
    public function setNumeric($numeric)
    {
        $this->_numeric = $numeric;
        return $this;
    }
    
    /**
     * Returns if the question's answer is numeric
     * @return boolean
     */
    public function isNumeric()
    {
        return (1 == $this->_numeric);
    }
    
    /**
     * Setter for Max Value
     * @param int $value
     * @return Application_Model_Question
     */
    public function setMax($value)
    {
        $this->_maxValue = $value;
        return $this;
    }
    
    /**
     * Getter for Max Value
     * @return int
     */
    public function getMax()
    {
        return $this->_maxValue;
    }
    
    /**
     * Setter for Min Value
     * @param int $value
     * @return Application_Model_Question
     */
    public function setMin($value)
    {
        $this->_minValue = $value;
        return $this;
    }
    
    /**
     * Getter for Min Value
     * @return int
     */
    public function getMin()
    {
        return $this->_minValue;
    }
    
    /**
     * Setter for hasDependent
     * @param bool $hasDependent
     * @return Application_Model_Question
     */
    public function setHasDependent($hasDependent)
    {
        $this->_hasDependent = $hasDependent;
        return $this;
    }
    
    /**
     * Does the question has dependents?
     * @return boolean
     */
    public function hasDependent()
    {
        return (1 == $this->_hasDependent);
    }        
    
    /**
     * Setter for dependsOf
     * @param int $dependsOf
     * @return Application_Model_Question
     */
    public function setDependsOf($dependsOf) 
    {
        $this->_dependsOf = $dependsOf;
        return $this;
    }
    
    /**
     * Getter for dependsOf
     * @return int
     */
    public function getDependsOf()
    {
        return $this->_dependsOf;
    }
    
    /**
     * Checks if the question should be hidden from the form
     * @return boolean
     */
    public function isHidden()
    {
        return !is_null($this->_dependsOf);
    }
}