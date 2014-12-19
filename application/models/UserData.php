<?php

/**
 * Class to model the user data
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_UserData 
{
     /**
      * Id of the Answer
      * @var int
      */
     protected $_id;
     
     /**
      * Id of the user
      * @var int
      */
     protected $_userId;
     
     /**
      * Id of the block
      * @var int
      */
     protected $_blockId;
     
     /**
      * Array containing the user's responses
      * @var unknown
      */
     protected $_results;
     
    
     
     public function __construct($userId, $blockId, $results) 
     {
         $this->_userId = $userId;
         $this->_blockId = $blockId;
         $this->_results = $results;
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_UserData
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
      * Setter of the user id
      * @param int $id
      * @return Application_Model_UserData
      */
     public function setUserId($userId)
     {
         $this->_userId = $userId;
         return $this;
     }
      
     /**
      * Getter of the user id
      * @return int
      */
     public function getUserId()
     {
         return $this->_userId;
     }
     
     /**
      * Setter of the block id
      * @param int $id
      * @return Application_Model_UserData
      */
     public function setBlockId($blockId)
     {
         $this->_blockId = $blockId;
         return $this;
     }
      
     /**
      * Getter of the block id
      * @return int
      */
     public function getBlockId()
     {
         return $this->_blockId;
     }
     
     /**
      * Setter of the resutls
      * @param array $results
      * @return Application_Model_UserData
      */
     public function setResults($results)
     {
         $this->_results = $results;
         return $this;
     }
      
     /**
      * Getter of the results
      * @return array
      */
     public function getResults()
     {
         return $this->_results;
     }
     
    
     
}