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

        $nodesElement = $xml->createElement("nodes");
        foreach ($this->_nodes as $key => $node) {
          $nodeElement = $xml->createElement("node");
          $nodeElement->setAttribute("id", $node->getId());
          $nodeElement->setAttribute("label", $node->getName());
          $vizElement = $xml->createElement("viz:size");
          $vizElement->setAttribute("value", $node->getSize());          
          $nodeElement->appendChild($vizElement);
          $vizElement = $xml->createElement("viz:color");
          $vizElement->setAttribute("r", $node->getColorScale('r'));
          $vizElement->setAttribute("g", $node->getColorScale('g'));
          $vizElement->setAttribute("b", $node->getColorScale('b'));          
          $nodeElement->appendChild($vizElement);
          $vizElement = $xml->createElement("viz:position");
          $vizElement->setAttribute("x", $node->getPosition());
          $vizElement->setAttribute("y", $node->getPosition());
          $vizElement->setAttribute("z", "0");          
          $nodeElement->appendChild($vizElement);
          
          $nodesElement->appendChild($nodeElement);
        }
        $graph->appendChild($nodesElement);

        $edgesElement = $xml->createElement("edges");
        foreach ($this->_edges as $key => $edge) {
          $edgeElement = $xml->createElement("edge");
          $edgeElement->setAttribute("id", $edge->getId());
          $edgeElement->setAttribute("source", $edge->getSource());
          $edgeElement->setAttribute("target", $edge->getTarget());
          $vizElement = $xml->createElement("viz:color");
          $vizElement->setAttribute("r", $edge->getColorScale('r'));
          $vizElement->setAttribute("g", $edge->getColorScale('g'));
          $vizElement->setAttribute("b", $edge->getColorScale('b'));          
          $edgeElement->appendChild($vizElement);
          $edgesElement->appendChild($edgeElement);
        }
        $graph->appendChild($edgesElement);

        $root->appendChild($graph);
        $xml->formatOutput = false;
        $xml->preserveWhiteSpace = false;

        $this->saveReport($this->_userId, $xml);
        // echo "<xmp>". $xml->saveXML() ."</xmp>";die();
        $xmlString = $this->prepareXmlContent($xml->saveXML());
        return $xmlString;
     }     

     /**
      * Saves the GEXF report in the server
      * @param  [type] $name           [Name to be given to the report]
      * @param  [DOMDocument] $xml     [XML Object]
      */
     private function saveReport($name, $xml) 
     {
        $xml->save("gexf/report-$name.gexf") or die("Error");      
     }

     /**
      * Prepares the XML string to be delivered to the Sigma Library
      * @param  [string] $xml [description]
      * @return [string]      [String representation of the XML]
      */
     private function prepareXmlContent($xml) {
        $xml = str_replace('<?xml version="1.0" encoding="UTF-8"?>','',$xml);
        $xml = trim($xml);
        return $xml;
     }

}