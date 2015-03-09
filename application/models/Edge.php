<?php

/**
 * Class to model the GEXF Edges
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Edge
{
     /**
      * Constants for the Edge types
      */
     const EDGE_NORMAL = 1;
     const EDGE_FIRST_DEGREE_CONTACT = 2;
     const EDGE_SECOND_DEGREE_CONTACT = 3;


     /**
      * Id of the Edge
      * @var int
      */
     protected $_id;
     
     /**
      * Source of the Edge
      * @var int
      */
     protected $_source;

     /**
      * Target of the Edge
      * @var int
      */
     protected $_target;
     
    
     
     public function __construct(array $options = null) 
     {
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_Edge
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
      * Setter of the source 
      * @param int $source
      * @return Application_Model_Edge
      */
     public function setSource($source)
     {
         $this->_source = $source;
         return $this;
     }
     
     /**
      * Getter of the source
      * @return int
      */
     public function getSource() 
     {
         return $this->_source;
     }

     /**
      * Setter of the target 
      * @param int $target
      * @return Application_Model_Edge
      */
     public function setTarget($target)
     {
         $this->_target = $target;
         return $this;
     }
     
     /**
      * Getter of the target
      * @return int
      */
     public function getTarget() 
     {
         return $this->_target;
     }
     
     
     
}