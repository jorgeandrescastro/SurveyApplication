<?php

/**
 * Mapper for the usser table
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_UserMapper extends Application_Model_AbstractMapper
{
	/**
	 * DB table class name for User
	 * @var int
	 */
	private $_dbTableClassName = 'Application_Model_DbTable_User'; 
    
    /**
     * Finds a user
     * @param int $id
     * @return void|Application_Model_User
     */
    public function find($id) 
    {
        $result = $this->getDbTable($this->_dbTableClassName)->find($id);       
        if(0 == count($result))
        {
        	return;
        }
        
        $row = $result->current();
        
        $user = new Application_Model_User();
        
        $user->setId($row->id)
             ->setFbid($row->id)
             ->setName($row->name)
             ->setStartDate($row->startDate)
             ->setFinishDate($row->finishDate)
             ->setCurrentBlock($row->currentBlock);
        
        return $user;
    }
    

    /**
     * Finds a User by its facebook id
     * @param int $facebookId
     * @return void|Application_Model_User
     */
    public function findByFacebookId($facebookId)
    {
        $select = $this->getDbTable($this->_dbTableClassName)
                       ->select()->where('fbid = ?', $facebookId)->limit(1);
        
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
        
        if(count($resultSet) > 0) {
            $row = current($resultSet);
            $user = new Application_Model_User($row['fbid'], $row['name']);
            $user->setCurrentBlock($row['currentBlock'])
                 ->setFinishDate($row['finishDate'])
                 ->setStartDate($row['startDate'])
                 ->setId($row['id']);
            
            return $user;            
        }
        
        return;
    }
    
    /**
     * Persists a user information in the database
     * @param Application_Model_User $user
     * @return int
     */
    public function save(Application_Model_User $user) 
    {
        $data = array(
        	'id' => $user->getId(),
        	'fbid' => $user->getFbid(),
        	'name' => $user->getName(),
        	'startDate' => $user->getStartDate(),
        	'finishDate' => $user->getFinishDate(),
        	'currentBlock' => $user->getCurrentBlock()
        			
        );
        
        if($this->isPersisted($user)) {
            return $this->getDbTable($this->_dbTableClassName)->update($data, array('id = ?' => $data['id']));
        } else {
            unset($data['id']);
            $userId = $this->getDbTable($this->_dbTableClassName)->insert($data);
            return $userId;
        }
        
    }
    
    /**
     * Checks if the user has already been persisted
     * @param Application_Model_User $user
     * @return boolean
     */
    private function isPersisted(Application_Model_User $user)
    {
        if (!is_null($user->getId())) {
            return true;
        }
        
        $userPersisted = $this->findByFacebookId($user->getFbid());
        
        if(!is_null($userPersisted)) {
            return true;
        }
        
        return false;
        
    }
     
}