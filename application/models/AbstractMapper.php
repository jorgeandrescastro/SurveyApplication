<?php

/**
 * Abstract of the mapper
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
abstract class Application_Model_AbstractMapper 
{
    /**
     * DB table
     * @var Zend_Db_Table_Abstract
     */
    protected $_dbTable;
    
    /**
     * Sets DB table
     * @param Zend_Db_Table_Abstract $dbTable
     * @throws Exception
     * @return Application_Model_SurveyMapper
     */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    /**
     * Gets DB table
     * @param string $dbTableClassName
     * @return Zend_Db_Table_Abstract
     */
    public function getDbTable($dbTableClassName)
    {
    	if (null === $this->_dbTable) {
            $this->setDbTable($dbTableClassName);
        }
     
        return $this->_dbTable;
    }
    
}