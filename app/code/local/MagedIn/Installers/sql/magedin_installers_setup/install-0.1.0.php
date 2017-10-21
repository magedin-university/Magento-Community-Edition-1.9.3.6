<?php

/** @var MagedIn_Installers_Model_Resource_Setup $this */

$this->startSetup();

/** @var Magento_Db_Adapter_Pdo_Mysql $connection */
$connection = $this->getConnection(); // Or you can use the $conn which already exists.

/** @var string $tableName */
$tableName = $this->getTable('magedin_installers/main');

/** @var Varien_Db_Ddl_Table $table */
$table = $connection->newTable($tableName)
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, [
        'identity' => true,
        'nullable' => false,
        'primary'  => true,
    ], 'Table column ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, [
        'nullable' => false
    ])
    ->addColumn('age', Varien_Db_Ddl_Table::TYPE_INTEGER, 3, [
        'nullable' => false
    ]);

$connection->dropTable($tableName);
$connection->createTable($table);

$this->endSetup();
