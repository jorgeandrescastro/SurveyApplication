<?php

/**
 * Mapper for the users' results
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_UserDataMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for User Data
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_UserData';
    
    /**
     * Persists a user data information in the database
     * @param Application_Model_UserData $userData
     * @return int
     */
    public function save(Application_Model_UserData $userData)
    {
        $data = array(
                'id' => $userData->getId(),
                'user_id' => $userData->getUserId(),
                'block_id' => $userData->getBlockId(),
                'results' => serialize($userData->getResults())
        );
    
        if (is_null($data['id'])) {
            unset($data['id']);
            $userDataId = $this->getDbTable($this->_dbTableClassName)->insert($data);
            return $userDataId;
        } else {
            return $this->getDbTable($this->_dbTableClassName)->update($data, array('id = ?' => $data['id']));
        }
        
    }
    
    /**
     * Fetches the user data of a user
     * @param Application_Model_User $user
     * @return array 
     */
    public function getDataFromUser(Application_Model_User $user) 
    {
        $select = $this->getDbTable($this->_dbTableClassName)
                        ->select()->where('user_id = ?', $user->getId());
        
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
        $blockResponses = array();
        
        foreach($resultSet as $row) {
            $blockResponse = new Application_Model_UserData($row['user_id'], 
                                                            $row['block_id'],
                                                            unserialize($row['results']));
             
            $blockResponses[$row['block_id']] = $blockResponse;
        }
        
        return $blockResponses;
    }
    
}