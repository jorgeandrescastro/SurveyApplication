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

     public function generateGEXFReport()
     {
        $xml = new DOMDocument("1.0");
        $xml->encoding = "UTF-8";

        $root = $xml->createElement("gexf");
        $root->setAttribute("xmlns:viz", "http:///www.gexf.net/1.1draft/viz");
        $root->setAttribute("version", "1.1");
        $root->setAttribute("xmlns", "http://www.gexf.net/1.1draft");
        $xml->appendChild($root);

        $graph = $xml->createElement("graph");
        $graph->setAttribute("defaultedgetype", "directed");
        $graph->setAttribute("idtype", "string");
        $graph->setAttribute("type", "static");

        $attrs = $xml->createElement("attributes");
        $attrs->setAttribute("class", "node");
        $attrs->setAttribute("mode", "static");

        $attr1 = $xml->createElement("attribute");
        $attr1->setAttribute("id", "authority");
        $attr1->setAttribute("title", "Authority");
        $attr1->setAttribute("type", "float");

        $attr2 = $xml->createElement("attribute");
        $attr2->setAttribute("id", "hub");
        $attr2->setAttribute("title", "Hub");
        $attr2->setAttribute("type", "float");
        $attrs->appendChild($attr1);
        $attrs->appendChild($attr2);
        $graph->appendChild($attrs);
        

        $nodesElement = $xml->createElement("nodes");
        foreach ($this->_nodes as $key => $node) {
          $nodeElement = $xml->createElement("node");
          $nodeElement->setAttribute("id", $node->getId());
          $nodeElement->setAttribute("label", $node->getName());
          $nodesElement->appendChild($nodeElement);
        }
        $graph->appendChild($nodesElement);

        $edgesElement = $xml->createElement("edges");
        foreach ($this->_edges as $key => $edge) {
          $edgeElement = $xml->createElement("edge");
          $edgeElement->setAttribute("id", $edge->getId());
          $edgeElement->setAttribute("source", $edge->getSource());
          $edgeElement->setAttribute("target", $edge->getTarget());
          $edgesElement->appendChild($edgeElement);
        }
        $graph->appendChild($edgesElement);

        $root->appendChild($graph);
        $xml->formatOutput = true;
        echo "<xmp>". $xml->saveXML() ."</xmp>";
     }     

     /**
      * Saves the GEXF report in the server
      * @param  [type] $name           [Name to be given to the report]
      * @param  [DOMDocument] $xml     [XML Object]
      */
     private function saveReport($name, $xml) 
     {
        $xml->save("gexf/$name.gexf") or die("Error");      
     }

}