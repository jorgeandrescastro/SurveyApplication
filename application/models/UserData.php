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
      * @param  stdClass $user
      * @return [array]
      */
     public static function generateNodes($user_data, $user) {
        $nodes = array();
        $edges = array();

        $userId = $user_data[1]->getUserId();

        $nodeMapper = new Application_Model_NodeMapper();
        $edgeMapper = new Application_Model_EdgeMapper();
        $reportEdgeMapper = new Application_Model_ReportEdgeMapper();
        $blockResults = array (1 => $user_data[1]->getResults(),
                2 => $user_data[2]->getResults(),
                3 => $user_data[3]->getResults(),
        );

        $nodeMain = new Application_Model_Node();
        $nodeMain->setUser($userId);
        $nodeMain->setName($blockResults[1]['question_3']);
        $nodeMain->setType(Application_Model_Node::NODE_CONTACT);
        $nodeMapper->save($nodeMain);

        Application_Model_UserData::generateFriendsNodes($user, $nodeMain, $nodeMapper, $edgeMapper, $reportEdgeMapper);

        Application_Model_UserData::generateWorkInformationNodes($nodeMapper, $edgeMapper, $reportEdgeMapper, $blockResults[2]['question_58'],
                                            $blockResults[2]['question_18'], $blockResults[2]['question_21'],
                                            $blockResults[2]['question_24'], $nodeMain, $userId);

        Application_Model_UserData::generateWorkInformationNodes($nodeMapper, $edgeMapper, $reportEdgeMapper, $blockResults[3]['question_28'],
                                            $blockResults[3]['question_39'], $blockResults[3]['question_42'],
                                            $blockResults[3]['question_45'], $nodeMain, $userId);



        $companies_names = $blockResults[2]['question_16'];
        $companies = explode(PHP_EOL, $companies_names);
        foreach ($companies as $company) {
            $node = new Application_Model_Node();
            $node->setName(trim($company));
            $node->setType(Application_Model_Node::NODE_COMPANY);
            $nodeMapper->save($node);

            $edge = new Application_Model_Edge($nodeMain->getId(), $node->getId());
            $edgeMapper->save($edge);
            $reportEdgeMapper->save($user->getId(), $edge->getId());
        }

     }

     /**
      * Creates the nodes and edges for work relationships
      * @param Application_Model_NodeMapper $nodeMapper
      * @param Application_Model_EdgeMapper $edgeMapper
      * @param string $work
      * @param string $contact
      * @param string $contactWork
      * @param string $intermediary
      * @param string $nodeMain
      */
     private static function generateWorkInformationNodes($nodeMapper, $edgeMapper, $reportEdgeMapper, $work, $contact, $contactWork, $intermediary, $nodeMain, $userId) 
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
          $reportEdgeMapper->save($userId, $edge->getId());
        } else {
          $edge = new Application_Model_Edge($nodeMain->getId(), $nodeDirectContact->getId());
          $edgeMapper->save($edge);
          $reportEdgeMapper->save($userId, $edge->getId());
          if(!empty($nodeDirectWork)) {
            $edge = new Application_Model_Edge($nodeDirectContact->getId(), $nodeDirectWork->getId());
            $edgeMapper->save($edge);
            $reportEdgeMapper->save($userId, $edge->getId());
          }
          if(empty($nodeIndirectContact)) {
            $edge = new Application_Model_Edge($nodeDirectContact->getId(), $nodeWork->getId());
            $edgeMapper->save($edge);
            $reportEdgeMapper->save($userId, $edge->getId());
          } else {
            $edge = new Application_Model_Edge($nodeDirectContact->getId(), $nodeIndirectContact->getId());
            $edgeMapper->save($edge);
            $reportEdgeMapper->save($userId, $edge->getId());
            $edge = new Application_Model_Edge($nodeIndirectContact->getId(), $nodeWork->getId());
            $edgeMapper->save($edge);
            $reportEdgeMapper->save($userId, $edge->getId());
            if(!empty($nodeIndirectWork)) {
              $edge = new Application_Model_Edge($nodeIndirectContact->getId(), $nodeIndirectWork->getId());
              $edgeMapper->save($edge);
              $reportEdgeMapper->save($userId, $edge->getId());
            }
          }
        }
     }

     /**
      * Creates the nodes and edges for facebook friends
      * @param Application_Model_User $user
      * @param Application_Model_Node $nodeMain
      * @param Application_Model_NodeMapper $nodeMapper
      * @param Application_Model_EdgeMapper $edgeMapper
      * @param Application_Model_ReportEdgeMapper $reportEdgeMapper
      */
     private static function generateFriendsNodes($user, $nodeMain, $nodeMapper, $edgeMapper, $reportEdgeMapper) {
        $friends = explode(',',$user->getFacebookFriends());
        foreach ($friends as $friend) {
          $nodeFriend = new Application_Model_Node();
          $nodeFriend->setName(addslashes($friend));
          $nodeFriend->setType(Application_Model_Node::NODE_CONTACT);
          $nodeMapper->save($nodeFriend);

          $edgeFriend = new Application_Model_Edge($nodeMain->getId(), $nodeFriend->getId());
          $edgeMapper->save($edgeFriend);
          $reportEdgeMapper->save($user->getId(), $edgeFriend->getId());
        }
     }
     
}