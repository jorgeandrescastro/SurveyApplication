<?php

/**
 * Mapper for the Report related information
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_ReportMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for Node
     * @var string
     */
    private $_dbTableNodeClassName = 'Application_Model_DbTable_Node';

    /**
     * DB table class name for Edge
     * @var string
     */
    private $_dbTableEdgeClassName = 'Application_Model_DbTable_Edge';

    /**
     * DB table class name for ReportEdge
     * @var string
     */
    private $_dbTableReportEdgeClassName = 'Application_Model_DbTable_ReportEdge';
    
    /**
     * Feeds the Report information
     * @return void|Application_Model_Report
     */
    public function fetchReport($userId) 
    {
        $associatedNodes = $this->getAssociatedNodes($userId);

        //Fetches the Nodes
        $this->_dbTable = null;
        $select = $this->getDbTable($this->_dbTableNodeClassName)
            ->select()->where('id IN (?)', $associatedNodes['nodes']);
        
        $resultNodes = $this->getDbTable($this->_dbTableNodeClassName)->fetchAll($select);

        if(0 == count($resultNodes))
        {
            return;
        }
        $nodes = array();
        foreach($resultNodes as $row) {

            $node = new Application_Model_Node();
            $node->setId($row['id'])
                 ->setUser($row['user'])
                 ->setName(utf8_encode($row['name']))
                 ->setType($row['type']);
            
            if($node->getUser() == $userId) {
                $node->setType(Application_Model_Node::NODE_MAIN);
            }
            
            $nodes[$row['id']] = $node;
        }
        //Fetches the Edges
        $this->_dbTable = null;
        $select = $this->getDbTable($this->_dbTableEdgeClassName)
            ->select()->where('id IN (?)', $associatedNodes['edges']);
        $resultEdges = $this->getDbTable($this->_dbTableEdgeClassName)->fetchAll($select);

        if(0 == count($resultEdges))
        {
            return;
        }
        $edges = array();
        foreach($resultEdges as $row) {
            $edge = new Application_Model_Edge($row['source'], $row['target']);
            $edge->setId($row['id']);
            
            $edges[$row['id']] = $edge;
        }

        $report = new Application_Model_Report();
        $report->setUserid($userId);
        $report->setNodes($nodes);
        $report->setEdges($edges);

        return $report;
    }
    
    /**
     * [getAssociatedNodes Gets the Nodes and edges that belong to the user]
     * @param  [type] $userid [description]
     * @return [type]         [description]
     */
    private function getAssociatedNodes($userid) 
    {
        $select = $this->getDbTable($this->_dbTableReportEdgeClassName)
                ->select()->distinct('edge_id')->where('report_id = (?)', $userid);

        $resultSet = $this->getDbTable($this->_dbTableReportEdgeClassName)->getAdapter()->fetchAll($select);

        $edges = array_column($resultSet, 'edge_id');


        $this->_dbTable = null;
        $select = $this->getDbTable($this->_dbTableEdgeClassName)
                ->select()->where('id IN (?)', $edges);

        $resultSet = $this->getDbTable($this->_dbTableEdgeClassName)->getAdapter()->fetchAll($select);

        $nodes = array_unique(array_merge(array_column($resultSet, 'source'), 
                                    array_column($resultSet, 'target')));
    
        $associatedNodes = array('nodes' => $nodes, 'edges' => $edges);

        return $associatedNodes;
    }
    
}