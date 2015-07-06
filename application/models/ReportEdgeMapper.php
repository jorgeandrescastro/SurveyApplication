<?php

/**
 * Mapper for Report Edges
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_ReportEdgeMapper extends Application_Model_AbstractMapper
{
    
    /**
     * DB table class name for User Data
     * @var string
     */
    private $_dbTableClassName = 'Application_Model_DbTable_ReportEdge';
    
    /**
     * Persists a report edge
     * @param int $report_id
     * @param int $edge_id
     * @return int
     */
    public function save($report_id, $edge_id)
    {
        
        $existentReportEdge = $this->findReportEdge($report_id, $edge_id);
        $reportEdgeId = 0;
        if(is_null($existentReportEdge)) {
            $data = array(
                'report_id' => $report_id,
                'edge_id' => $edge_id,
            );
            $reportEdgeId = $this->getDbTable($this->_dbTableClassName)->insert($data);           
        }
    
        return $reportEdgeId;   
    }

    /**
     * Find a ReportEdge
     * @param int $report_id
     * @param int $edge_id
     * @return void|array
     */
    private function findReportEdge($report_id, $edge_id) {
        $select = $this->getDbTable($this->_dbTableClassName)
        ->select()->where('report_id = ?', $report_id)
                  ->where('edge_id = ?', $edge_id)->limit(1);
    
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
    
        if(count($resultSet) > 0) {
            $row = current($resultSet);
            return $row;
        }
    
        return;
    }

    /**
     * Find the ReportEdge by report id
     * @param int $report_id
     * @return void|array
     */
    private function findReportEdgeByReportId($report_id) {
        $select = $this->getDbTable($this->_dbTableClassName)
        ->select()->where('report_id = ?', $report_id);
    
        $resultSet = $this->getDbTable($this->_dbTableClassName)->getAdapter()->fetchAll($select);
    
        if(count($resultSet) > 0) {
            $row = current($resultSet);
            return $row;
        }
    
        return;
    }   
}