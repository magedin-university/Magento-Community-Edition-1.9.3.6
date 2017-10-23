<?php

trait MagedIn_Affiliates_Trait_Resource_Setup
{
    
    /** @var string */
    protected $mainTable = null;
    
    
    /**
     * @param Varien_Db_Ddl_Table $table
     *
     * @return Varien_Db_Ddl_Table
     *
     * @throws Zend_Db_Exception
     */
    public function addTimestamps(Varien_Db_Ddl_Table $table)
    {
        $this->addDatetimeColumn($table, 'created_at');
        $this->addDatetimeColumn($table, 'updated_at');
        
        return $table;
    }
    
    
    /**
     * @param Varien_Db_Ddl_Table $table
     *
     * @return Varien_Db_Ddl_Table
     *
     * @throws Zend_Db_Exception
     */
    public function addCustomTimestamp(Varien_Db_Ddl_Table $table, $columnName, $options = [], $comment = null)
    {
        if (!$columnName) {
            Mage::throwException($this->__('Column name cannot be empty.'));
        }
        
        if ($this->columnExists($table, $columnName)) {
            Mage::throwException($this->__('A column with the same name already exists or will be created.'));
        }
        
        if (empty($comment)) {
            $comment = str_replace('_', ' ', $comment);
            $comment = ucwords($comment);
        }
        
        $defaultOptions = [
            'unsigned' => true,
            'nullable' => true
        ];
        
        /** @var array $options */
        $options = array_merge((array) $options, $defaultOptions);
        $table->addColumn($columnName, Varien_Db_Ddl_Table::TYPE_DATETIME, null, $options, $comment);
        
        return $table;
    }
    
    
    /**
     * @param Varien_Db_Ddl_Table $table
     * @param string              $columnName
     *
     * @return bool
     */
    public function columnExists(Varien_Db_Ddl_Table $table, $columnName)
    {
        /** @var array $columns */
        $columns = $table->getColumns();
        
        if (isset($columns[strtoupper($columnName)])) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * @param Varien_Db_Ddl_Table $table
     *
     * @return Varien_Db_Ddl_Table
     *
     * @throws Zend_Db_Exception
     */
    public function addEntityId(Varien_Db_Ddl_Table $table, $field = 'id', $comment = 'Entity ID')
    {
        $table->addColumn($field, Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
            'identity' => true,
            'unsigned' => true,
            'primary'  => true,
            'nullable' => false,
        ], $comment);
        
        return $table;
    }
    
    
    /**
     * Return new DDL Table object
     *
     * @param bool   $addEntityId add entity id
     * @param string $tableName   the table name
     * @param string $schemaName  the database/schema name
     *
     * @return Varien_Db_Ddl_Table
     */
    public function newTable($tableName = null, $addEntityId = true, $dropTable = true, $schemaName = null)
    {
        if (!$tableName) {
            $tableName = $this->getMainTable();
        }
        
        if (false !== strpos($tableName, '/')) {
            $tableName = $this->getTable($tableName);
        }
        
        /**
         * Try to drop table before creating a new one.
         */
        if ($dropTable === true) {
            $this->dropTable($tableName);
        }
        
        $table = $this->getConnection()->newTable($tableName, $schemaName);
        
        if ($addEntityId === true) {
            $table = $this->addEntityId($table);
        }
        
        return $table;
    }
    
    
    /**
     * @param string $tableName
     * @param string $schemaName
     *
     * @return bool
     */
    public function dropTable($tableName = null, $schemaName = null)
    {
        if (!$tableName) {
            $tableName = $this->getMainTable();
        }
        
        if (false !== strpos($tableName, '/')) {
            $tableName = $this->getTable($tableName);
        }
        
        $result = $this->getConnection()->dropTable($tableName, $schemaName);
        
        return $result;
    }
    
    
    /**
     * @return string|null
     */
    public function getMainTable()
    {
        if (empty($this->mainTable)) {
            return null;
        }
        
        return $this->getTable($this->mainTable);
    }
    
    
    /**
     * @param string|Varien_Db_Ddl_Table $priTableName
     * @param string $priColumnName
     * @param string|Varien_Db_Ddl_Table $refTableName
     * @param string $refColumnName
     *
     * @return $this
     */
    public function addForeignKey($priTableName, $priColumnName, $refTableName, $refColumnName)
    {
        $priTableName = $this->resolveTableName($priTableName);
        $refTableName = $this->resolveTableName($refTableName);
        
        $fkName = $this->getFkName($priTableName, $priColumnName, $refTableName, $refColumnName);
        $this->getConnection()
            ->addForeignKey($fkName, $priTableName, $priColumnName, $refTableName, $refColumnName);
        
        return $this;
    }
    
    
    /**
     * Basically the difference between this method and the method `addIndex` is that this method is a mass indexes
     * creation while the method `addIndex` creates only one index per call.
     *
     * @param array  $fields
     * @param null   $table
     * @param string $indexType
     */
    public function addIndexes(
        $fields = array(), $table = null, $indexType = Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    )
    {
        $fields = (array) $fields;
        
        foreach ($fields as $_fields) {
            $this->addIndex($_fields, $table, $indexType);
        }
        
        return $this;
    }
    
    
    /**
     * @param array|string                $fields
     * @param string|\Varien_Db_Ddl_Table $table
     * @param string                      $indexType
     *
     * @return $this
     */
    public function addIndex($fields, $table = null, $indexType = Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
    {
        $table   = $this->resolveTableName($table);
        $idxName = $this->getIdxName($table, $fields);
        
        $this->getConnection()
            ->addIndex($table, $idxName, $fields, $indexType);
        
        return $this;
    }
    
    
    /**
     * @param Varien_Db_Ddl_Table $table
     *
     * @return Varien_Db_Ddl_Table
     *
     * @throws Zend_Db_Exception
     */
    public function addDatetimeColumn(Varien_Db_Ddl_Table $table, $name, array $options = array(), $comment = null)
    {
        $options['unsigned'] = true;
        $options['nullable'] = true;
        
        if (empty($comment)) {
            $comment = uc_words($name, ' ');
        }
        
        $table->addColumn($name, Varien_Db_Ddl_Table::TYPE_DATETIME, null, $options, $comment);
        
        return $table;
    }
    
    
    /**
     * @param string|null|Varien_Db_Ddl_Table $table
     *
     * @return null|string
     */
    protected function resolveTableName($table)
    {
        if ($table instanceof Varien_Db_Ddl_Table) {
            return $table->getName();
        }
        
        if (!$table) {
            $table = $this->getMainTable();
        }
        
        if (strpos($table, '/')) {
            $table = $this->getTable($table);
        }
        
        return $table;
    }

}
