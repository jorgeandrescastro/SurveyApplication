<?php

/**
 * Mapper for the nodes
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_NodeMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for Node
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_Node';
    
    /**
     * Persists a node in the database
     * @param Application_Model_Node $node
     * @return int
     */
    public function save(Application_Model_Node &$node) 
    {
        $data = array(
            'id' => $node->getId(),
            'user' => $node->getUser(),
            'name' => $node->getName(),
            'type' => $node->getType(),
        );        
        
        if (!is_null($node->getId())) {
            return $this->getDbTable($this->_dbTableClassName)->update($data, array('id = ?' => $data['id']));
        } else {

            $persistedNode = $this->findByNodeName($node->getName());
            if(is_null($persistedNode)) {
                unset($data['id']);
                $nodeId = $this->getDbTable($this->_dbTableClassName)->insert($data);
                $node->setId($nodeId);
                return $nodeId;
            } else {
                $node = $persistedNode;
                return $persistedNode->getId();
            }
            

        }
        
    }
    
    private function findByNodeName($name) {
        $select = $this->getDbTable($this->_dbTableClassName)
                       ->select()->where('name = ?', $name)->limit(1);
        
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
        
        if(count($resultSet) > 0) {
            $row = current($resultSet);
            $node = new Application_Model_Node();
            $node->setId($row['id'])
                 ->setUser($row['user'])
                 ->setName($row['name'])
                 ->setType($row['type']);
        
            return $node;
        }
        
        return;
    }
    
}