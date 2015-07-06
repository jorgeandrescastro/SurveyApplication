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
     * FB raw data
     * @var array
     */
    private $_fbdata;
    
    /**
     * Flag for report generation
     * @var bool
     */
    private $_report;
    
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
     * @param bool $formatted
     * @return int
     */
    public function getStartDate($formatted = false)
    {
        if($formatted) {
            return ($this->_startDate > 0) ? date('d-m-Y H:i:s',$this->_startDate) : '0'; 
        }
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
     * @param bool $formatted 
     * @return int
     */
    public function getFinishDate($formatted = false)
    {
        if($formatted) {
            return ($this->_finishDate > 0) ? date('d-m-Y H:i:s',$this->_finishDate) : '0';
        }
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
     * Setter for the FB data
     * @param array $data
     * @return Application_Model_User
     */
    public function setFbdata($data)
    {
        $this->_fbdata = $data;
        return $this;
    }
    
    /**
     * Getter for the FB data
     * @return array
     */
    public function getFbdata()
    {
        return $this->_fbdata;
    }
    
    /**
     * Checks if the user has finished the survey
     * @return boolean
     */
    public function hasFinishedSurvey()
    {
        return ($this->_finishDate > $this->_startDate);
    }

    /**
     * Setter for report
     * @param int $report
     * @return Application_Model_User
     */
    public function setReport($report)
    {
        $this->_report = $report;
        return $this;
    }

    /**
     * Getter for report
     * @return int
     */
    public function getReport()
    {
        return $this->_report;
    }
    
    /**
     * Returns if the user has already a generated report
     * @return boolean
     */
    public function hasReport()
    {
        return (1 == $this->_report);
    }
    
    /**
     * Gets the jobs of the user 
     * @return string
     */
    public function getJobs() 
    {
        $jobs = ''; 
        if(isset($this->_fbdata[16])) {
            $jobs = implode(',',$this->_fbdata[16]);
        }
        return $jobs;
    }

    /**
     * Gets the facebook friends of the user 
     * @return string
     */
    public function getFacebookFriends()
    {
        $friends = ''; 
        if(isset($this->_fbdata['friends'])) {
            $friends = implode(',',$this->_fbdata['friends']);
        }

        return $friends;
    }
}