<?php

/**
 * Mapper for the Edges
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_EdgeMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for Edge
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_Edge';
    
    /**
     * Persists an edge in the database
     * @param Application_Model_Edge $edge
     * @return int
     */
    public function save(Application_Model_Edge &$edge) 
    {
        $data = array(
            'id' => $edge->getId(),
            'source' => $edge->getSource(),
            'target' => $edge->getTarget(),
        );
        
        $existingEdge = $this->findEdge($edge->getSource(), $edge->getTarget());
        if(!is_null($existingEdge)) {
            $edge = $existingEdge;
            $data['id'] = $edge->getId();
        }
        
        if (!is_null($edge->getId())) {
            return $this->getDbTable($this->_dbTableClassName)->update($data, array('id = ?' => $data['id']));
        } else {
            unset($data['id']);
            $edgeId = $this->getDbTable($this->_dbTableClassName)->insert($data);
            $edge->setId($edgeId);
            return $edgeId;
        }
        
    }
    
    /**
     * Find an Edge by its source and target
     * @param int $source
     * @param int $target
     * @return void|Application_Model_Edge
     */
    private function findEdge($source, $target) {
        $select = $this->getDbTable($this->_dbTableClassName)
        ->select()->where('source = ?', $source)
                  ->where('target = ?', $target)->limit(1);
    
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
    
        if(count($resultSet) > 0) {
            $row = current($resultSet);
            $edge = new Application_Model_Edge();
            $edge->setId($row['id'])
            ->setSource($row['source'])
            ->setTarget($row['target']);
    
            return $edge;
        }
    
        return;
    }
    
}