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


     protected $_colors = array(
                          Application_Model_Node::NODE_MAIN => array('r' => 128, 'g' => 0, 'b' => 0),
                          Application_Model_Node::NODE_USER => array('r' => 255, 'g' => 255, 'b' => 255),
                          Application_Model_Node::NODE_CONTACT => array('r' => 255, 'g' => 165, 'b' => 0),
                          Application_Model_Node::NODE_COMPANY => array('r' => 0, 'g' => 128, 'b' => 0));

     /**
      * Id of the Node
      * @var int
      */
     protected $_id;

     /**
      * Id of the User ID
      * @var int
      */
     protected $_user;
     
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
      * Setter of the user 
      * @param int $user
      * @return Application_Model_Node
      */
     public function setUser($user)
     {
         $this->_user = $user;
         return $this;
     }
     
     /**
      * Getter of the user
      * @return int
      */
     public function getUser() 
     {
         return $this->_user;
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

     /**
      * Getter of the color of the node
      * @param  int $scaleColor
      * @return int
      */
     public function getColorScale($scaleColor) 
     {
         return $this->_colors[$this->_type][$scaleColor];
     }
     
     /**
      * Getter for the position of the node
      * @return int
      */
     public function getPosition() {
         if($this->_type == $this::NODE_MAIN) {
             return 0;
         } else {
             return rand(-200, 200);
         }
     }


     /**
      * Gets the size the node should be displayed in
      * @return int
      */
     public function getSize() {
        switch ($this->_type) {
          case Application_Model_Node::NODE_MAIN:
            $size = 3;
            break;
          case Application_Model_Node::NODE_COMPANY:
            $size = 2;
            break;
          
          default:
            $size = 1;
            break;
        }
        return $size;
     }
     
}