<?php

/**
 * Class to Model the users of the survey
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_User
{
	/**
	 * Internal Id of the user
	 * @var int
	 */
	private $_id;
	
    /**
     * Facebook ID of the user
     * @var int
     */
    private $_fbid;
    
    /**
     * Name of the user
     * @var string
     */
    private $_name;
    
    /**
     * Timestamp Date in which the user started the survey
     * @var int
     */
    private $_startDate;
    
    /**
     * Timestamp Date in which the user ended the survey
     * @var int
     */
    private $_finishDate;
    
    /**
     * Survey Block being filled in
     * @var int
     */
    private $_currentBlock;
    
    /**
     * Strategy for the survey
     * @var 
     */
    private $_userTypeStrategy;
    
    /**
     * Constructor of the user
     * @param array $options
     * @param int $fbid
     * @param string $name
     */
    public function __construct($fbid = '', $name = '')
    {
    	$this->_fbid         = $fbid;
    	$this->_name         = $name;
    	$this->_startDate    = time();
    	$this->_finishDate   = 0;
    	$this->_currentBlock = 0;
    }
    
    /**
     * Setter for the ID
     * @param int $id
     * @return Application_Model_User
     */ 
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }
    
    /**
     * Getter for the ID
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /**
     * Setter for the Facebook id
     * @param int $fbid
     * @return Application_Model_User
     */
    public function setFbid($fbid)
    {
        $this->_fbid = $fbid;
        return $this;
    }
    
    /**
     * Getter for the Facebook id
     * @return int
     */
    public function getFbid()
    {
        return $this->_fbid;
    }
    
    /**
     * Setter for the Name
     * @param string $name
     * @return Application_Model_User
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }
    
    /**
     * Getter for the Name
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * Setter for the Start Date
     * @param int $startDate
     * @return Application_Model_User
     */
    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
        return $this;
    }
    
    /**
     * Getter for the Start Date
     * @return int
     */
    public function getStartDate()
    {
        return $this->_startDate;
    }
    
    /**
     * Setter for the finish Date
     * @param int $finishDate
     * @return Application_Model_User
     */
    public function setFinishDate($finishDate)
    {
        $this->_finishDate = $finishDate;
        return $this;
    }
    
    /**
     * Getter for the Finish Date
     * @return int
     */
    public function getFinishDate()
    {
        return $this->_finishDate;
    }
    
    /**
     * Setter for the Current Block
     * @param int $currentBlock
     * @return Application_Model_User
     */
    public function setCurrentBlock($currentBlock)
    {
        $this->_currentBlock = $currentBlock;
        return $this;
    }
    
    /**
     * Getter for the Current Block
     * @return int
     */
    public function getCurrentBlock()
    {
        return $this->_currentBlock;
    }
    
    /**
     * Checks if the user has finished the survey
     * @return boolean
     */
    public function hasFinishedSurvey()
    {
        return ($this->_finishDate > $this->_startDate);
    }
}