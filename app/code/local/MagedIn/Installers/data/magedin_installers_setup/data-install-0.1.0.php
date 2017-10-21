<?php

/** @var MagedIn_Installers_Model_Resource_Setup $this */

$this->startSetup();

/** @var Magento_Db_Adapter_Pdo_Mysql $connection */
$connection = $this->getConnection(); // Or you can use the $conn which already exists.

/** @var string $tableName */
$tableName = $this->getTable('magedin_installers/main');

$connection->insert($tableName, [
    'id' => 1,
    'name' => 'Tiago',
    'age' => 30
]);

$connection->insert($tableName, [
    'id' => 2,
    'name' => 'Jorge',
    'age' => 27
]);

$connection->insert($tableName, [
    'id' => 3,
    'name' => 'Camila',
    'age' => 21
]);

$this->endSetup();
