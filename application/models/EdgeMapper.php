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
        
        if (!is_null($edge->getId())) {
            return $this->getDbTable($this->_dbTableClassName)->update($data, array('id = ?' => $data['id']));
        } else {
            unset($data['id']);
            $edgeId = $this->getDbTable($this->_dbTableClassName)->insert($data);
            $edge->setId($edgeId);
            return $edgeId;
        }
        
    }
    
}