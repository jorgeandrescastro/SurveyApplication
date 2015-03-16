<?php

/**
 * Class to model the user data
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_UserData 
{
     /**
      * Id of the Answer
      * @var int
      */
     protected $_id;
     
     /**
      * Id of the user
      * @var int
      */
     protected $_userId;
     
     /**
      * Id of the block
      * @var int
      */
     protected $_blockId;
     
     /**
      * Array containing the user's responses
      * @var unknown
      */
     protected $_results;
     
    
     
     public function __construct($userId, $blockId, $results) 
     {
         $this->_userId = $userId;
         $this->_blockId = $blockId;
         $this->_results = $results;
     }
     
     /**
      * Setter of the id 
      * @param int $id
      * @return Application_Model_UserData
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
      * @param int $id
      * @return Application_Model_UserData
      */
     public function setUserId($userId)
     {
         $this->_userId = $userId;
         return $this;
     }
      
     /**
      * Getter of the user id
      * @return int
      */
     public function getUserId()
     {
         return $this->_userId;
     }
     
     /**
      * Setter of the block id
      * @param int $id
      * @return Application_Model_UserData
      */
     public function setBlockId($blockId)
     {
         $this->_blockId = $blockId;
         return $this;
     }
      
     /**
      * Getter of the block id
      * @return int
      */
     public function getBlockId()
     {
         return $this->_blockId;
     }
     
     /**
      * Setter of the resutls
      * @param array $results
      * @return Application_Model_UserData
      */
     public function setResults($results)
     {
         $this->_results = $results;
         return $this;
     }
      
     /**
      * Getter of the results
      * @return array
      */
     public function getResults()
     {
         return $this->_results;
     }
     
     /**
      * Generate nodes and edges out of the user data
      * @param  array $user_data
      * @return [array]
      */
     public static function generateNodes($user_data) {
        $nodes = array();
        $edges = array();

        $nodeMapper = new Application_Model_NodeMapper();
        $edgeMapper = new Application_Model_EdgeMapper();

        $nodeMain = new Application_Model_Node();
        $nodeMain->setUser($user_data[1]->getUserId());
        $nodeMain->setName($user_data[1]->getResults()['question_3']);
        $nodeMain->setType(Application_Model_Node::NODE_MAIN);
        $nodeMapper->save($nodeMain);

        

        die();



        $node = new Application_Model_Node();
        $node->setName($user_data[2]->getResults()['question_58']);
        $node->setType(4);
        // $nodeMapper->save($node);

        $companies_names = $user_data[2]->getResults()['question_16'];
        $companies = explode(PHP_EOL, $companies);
        foreach ($companies as $company) {
            $node = new Application_Model_Node();
            $node->setName($company);
            $node->setType(4);
            // $nodeMapper->save($node);
        }



        die(); 

     }

     private function generateWorkInformationNodes($work, $contact, @contactWork, $intermediary, $nodeMain) 
     {
        $nodeWork = new Application_Model_Node();
        $nodeWork->setName($user_data[2]->getResults()['question_58']);
        $nodeWork->setType(Application_Model_Node::NODE_COMPANY);
        $nodeMapper->save($nodeWork);


        if(!empty($user_data[2]->getResults()['question_18'])) {          
            $nodeDirectContact = new Application_Model_Node();
            $nodeDirectContact->setName($user_data[2]->getResults()['question_18']);
            $nodeDirectContact->setType(Application_Model_Node::NODE_CONTACT);
            $nodeMapper->save($nodeDirectContact);

            if(!empty($user_data[2]->getResults()['question_21'])) {
                $nodeDirectWork = new Application_Model_Node();
                $nodeDirectWork->setName($user_data[2]->getResults()['question_21']);
                $nodeDirectWork->setType(Application_Model_Node::NODE_COMPANY);
                $nodeMapper->save($nodeDirectWork);              
            }
        }

        if(!empty($user_data[2]->getResults()['question_24'])) {
            $nodeIndirectContact = new Application_Model_Node();
            $nodeIndirectContact->setName('Contacto Intermedio');
            $nodeIndirectContact->setType(Application_Model_Node::NODE_CONTACT);
            $nodeMapper->save($nodeIndirectContact);

            if(!empty($user_data[2]->getResults()['question_24'])) {
                $nodeIndirectWork = new Application_Model_Node();
                $nodeIndirectWork->setName($user_data[2]->getResults()['question_24']);
                $nodeIndirectWork->setType(Application_Model_Node::NODE_COMPANY);
                $nodeMapper->save($nodeIndirectWork);
            }
        }

        if(empty($nodeDirectContact)) {
          $edge = new Application_Model_Edge($nodeMain->getId(), $nodeWork->getId());
          $edgeMapper->save($edge);
        } else {
          $edge = new Application_Model_Edge($nodeMain->getId(), $nodeDirectContact->getId());
          $edgeMapper->save($edge);
          if(!empty($nodeDirectWork)) {
            $edge = new Application_Model_Edge($nodeDirectContact->getId(), $nodeDirectWork->getId());
            $edgeMapper->save($edge);
          }
          if(empty($nodeIndirectContact)) {
            $edge = new Application_Model_Edge($nodeDirectContact->getId(), $nodeWork->getId());
            $edgeMapper->save($edge);
          } else {
            $edge = new Application_Model_Edge($nodeDirectContact->getId(), $nodeIndirectContact->getId());
            $edgeMapper->save($edge);
            $edge = new Application_Model_Edge($nodeIndirectContact->getId(), $nodeWork->getId());
            $edgeMapper->save($edge);
            if(!empty($nodeIndirectWork)) {
              $edge = new Application_Model_Edge($nodeIndirectContact->getId(), $nodeIndirectWork->getId());
              $edgeMapper->save($edge);
            }
          }
        }
     }
     
}