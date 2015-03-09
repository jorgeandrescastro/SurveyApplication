<?php

/**
 * Class to model the GEXF Nodes
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Node 
{   
     /**
      * Constants for the node types
      */
     const NODE_MAIN = 1;
     const NODE_USER = 2;
     const NODE_CONTACT = 3;
     const NODE_COMPANY = 4;


     /**
      * Id of the Node
      * @var int
      */
     protected $_id;
     
     /**
      * Name of the Node
      * @var string
      */
     protected $_name;

     /**
      * Type of the Node
      * @var int
      */
     protected $_type;
     
    
     
     public function __construct(array $options = null) 
     {
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_Node
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
      * Setter of the Name
      * @param string $name
      * @return Application_Model_Node
      */
     public function setName($name)
     {
         $this->_name = $name;
         return $this;
     }
     
     /**
      * Getter of the Name
      * @return string
      */
     public function getName() 
     {
         return $this->_name;
     }

     /**
      * Setter of the Type
      * @param int $type
      * @return Application_Model_Node
      */
     public function setType($type)
     {
         $this->_type = $type;
         return $this;
     }
     
     /**
      * Getter of the type
      * @return int
      */
     public function getType() 
     {
         return $this->_type;
     }
     
}