<?php

/**
 * Factory to create instances of the mappers
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_MapperFactory 
{
    /**
     * Static Functions to return all the mappers in an array
     * @return array
     * 
     */
    public static function getMappers()
    {
        return array(
            'USER'     => new Application_Model_UserMapper(),
            'SURVEY'   => new Application_Model_SurveyMapper(),
            'BLOCK'    => new Application_Model_BlockMapper(),
            'QUESTION' => new Application_Model_QuestionMapper(),
            'ANSWER'   => new Application_Model_AnswerMapper(),
            'USERDATA' => new Application_Model_UserDataMapper()          
        );
    }
}