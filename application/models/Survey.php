<?php

/**
 * Class to model Surveys
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Survey  
{
    /**
     * Id of the Survey
     * @var int
     */
    protected $_id;
    
    /**
     * Name of the survey
     * @var string
     */
    protected $_name;
    
    /**
     * Description of the survey
     * @var string
     */
    protected $_description;
    
    /**
     * Blocks from the survey
     * @var array
     */
    protected $_blocks;
    
    /**
     * ID of the default survey
     * @var int
     */
    public static $DEFAULT_SURVEY = 1;
    
    public function __construct(array $options = null) 
    {}
    
    /**
     * Setter for the ID
     * @param int $id
     * @return Application_Model_Survey
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
     * Setter for the name
     * @param string $name
     * @return Application_Model_Survey
     */
    public function setName($name) 
    {
        $this->_name = $name;
        return $this;
    }
    
    /**
     * Getter for the name 
     * @return string
     */
    public function getName()
    {
        return utf8_encode($this->_name);
    }
    
    /**
     * Setter for description
     * @param string $description
     * @return Application_Model_Survey
     */
    public function setDescription($description) 
    {
        $this->_description = $description;
        return $this;
    }
    
    /**
     * Getter for description
     * @return string
     */
    public function getDescription()
    {
        return utf8_encode($this->_description);
    }
    
    /**
     * Setter for the blocks
     * @param array $blocks
     * @return Application_Model_Survey
     */
    public function setBlocks($blocks)
    {
        $this->_blocks = $blocks;
        return $this;
    }
    
    /**
     * Getter for the blocks
     * @return array
     */
    public function getBlocks()
    {
        return $this->_blocks;
    }
    
    /**
     * Returns the first block of the survey
     * @return Application_Model_Block
     */
    public function getInitialBlock()
    {
        return reset($this->_blocks);
    }
    
    /**
     * Returns the last block of the survey
     * @return Application_Model_Block
     */
    public function getFinalBlock()
    {
        return end($this->_blocks);
    }
    
    /**
     * Returns the next block on the survey
     * @param int $currentBlock
     * @return Application_Model_Block
     */
    public function getNextBlock($currentBlock)
    {
        $blockAmount = count($this->_blocks);
        $x = 0;
        while($x < $blockAmount) {
            $block = current($this->_blocks);
            if($block->getId() == $currentBlock){
                return next($this->_blocks);
            }
            next($this->_blocks);
            $x++;
        }
        
        return;
    }
}