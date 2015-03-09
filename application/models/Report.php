<?php

/**
 * Class to model the GEXF Reports
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Report
{

     /**
      * Id of the Report
      * @var int
      */
     protected $_id;
     
     /**
      * User of the report
      * @var int
      */
     protected $_userId;

     /**
      * Nodes of the Report
      * @var array
      */
     protected $_nodes;

     /**
      * Edges of the Report
      * @var array
      */
     protected $_edges;     
     
    
     
     public function __construct(array $options = null) 
     {
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_Report
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
      * @param int $user_id
      * @return Application_Model_Report
      */
     public function setUserid($user_id)
     {
         $this->_userId = $user_id;
         return $this;
     }
     
     /**
      * Getter of the user id
      * @return int
      */
     public function getUserid() 
     {
         return $this->_userId;
     }

     /**
      * Setter of the nodes
      * @param array $nodes
      * @return Application_Model_Report
      */
     public function setNodes($nodes)
     {
         $this->_nodes = $nodes;
         return $this;
     }
     
     /**
      * Getter of the nodes
      * @return array
      */
     public function getNodes() 
     {
         return $this->_nodes;
     }

     /**
      * Setter of the edges
      * @param array $edges
      * @return Application_Model_Report
      */
     public function setEdges($edges)
     {
         $this->_edges = $edges;
         return $this;
     }
     
     /**
      * Getter of the edges
      * @return array
      */
     public function getEdges() 
     {
         return $this->_edges;
     }

     private function generateGEXFReport()
     {
        //TODO
     }     

}