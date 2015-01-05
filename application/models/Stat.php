<?php

/**
 * Class to generate the statistics of the survey's respondents
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_Stat
{
    public static function getSurveyStats() 
    {
        $userMapper = new Application_Model_UserMapper();
        $counts = $userMapper->getUserCounts();
        $counts['cr'] = $counts['total'] > 0 ?
                        ceil(($counts['finished'] / $counts['total']) * 100) : 0;
        $counts['incomplete'] = $counts['total'] - $counts['finished'];

        return $counts;
    }
}