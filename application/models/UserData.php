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
        $blockResults = array (1 => $user_data[1]->getResults(),
                2 => $user_data[2]->getResults(),
                3 => $user_data[3]->getResults(),
        );

        $nodeMain = new Application_Model_Node();
        $nodeMain->setUser($user_data[1]->getUserId());
        $nodeMain->setName($blockResults[1]['question_3']);
        $nodeMain->setType(Application_Model_Node::NODE_CONTACT);
        $nodeMapper->save($nodeMain);

        Application_Model_UserData::generateWorkInformationNodes($nodeMapper, $edgeMapper, $blockResults[2]['question_58'],
                                            $blockResults[2]['question_18'], $blockResults[2]['question_21'],
                                            $blockResults[2]['question_24'], $nodeMain);

        Application_Model_UserData::generateWorkInformationNodes($nodeMapper, $edgeMapper, $blockResults[3]['question_28'],
                                            $blockResults[3]['question_39'], $blockResults[3]['question_42'],
                                            $blockResults[3]['question_45'], $nodeMain);



        $companies_names = $blockResults[2]['question_16'];
        $companies = explode(PHP_EOL, $companies_names);
        foreach ($companies as $company) {
            $node = new Application_Model_Node();
            $node->setName(trim($company));
            $node->setType(Application_Model_Node::NODE_COMPANY);
            $nodeMapper->save($node);

            $edge = new Application_Model_Edge($nodeMain->getId(), $node->getId());
            $edgeMapper->save($edge);
        }

     }

     private static function generateWorkInformationNodes($nodeMapper, $edgeMapper, $work, $contact, $contactWork, $intermediary, $nodeMain) 
     {
        $nodeWork = new Application_Model_Node();
        $nodeWork->setName($work);
        $nodeWork->setType(Application_Model_Node::NODE_COMPANY);
        $nodeMapper->save($nodeWork);


        if(!empty($contact)) {          
            $nodeDirectContact = new Application_Model_Node();
            $nodeDirectContact->setName($contact);
            $nodeDirectContact->setType(Application_Model_Node::NODE_CONTACT);
            $nodeMapper->save($nodeDirectContact);

            if(!empty($contactWork)) {
                $nodeDirectWork = new Application_Model_Node();
                $nodeDirectWork->setName($contactWork);
                $nodeDirectWork->setType(Application_Model_Node::NODE_COMPANY);
                $nodeMapper->save($nodeDirectWork);              
            }
        }

        if(!empty($intermediary)) {
            $nodeIndirectContact = new Application_Model_Node();
            $nodeIndirectContact->setName('Contacto Intermedio');
            $nodeIndirectContact->setType(Application_Model_Node::NODE_CONTACT);
            $nodeMapper->save($nodeIndirectContact);

            if(!empty($intermediary)) {
                $nodeIndirectWork = new Application_Model_Node();
                $nodeIndirectWork->setName($intermediary);
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