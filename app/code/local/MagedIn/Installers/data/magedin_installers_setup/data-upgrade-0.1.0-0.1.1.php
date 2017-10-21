<?php

/** @var MagedIn_Installers_Model_Resource_Setup $this */

$this->startSetup();

/** @var Magento_Db_Adapter_Pdo_Mysql $connection */
$connection = $this->getConnection(); // Or you can use the $conn which already exists.

/** @var string $tableName */
$tableName = $this->getTable('magedin_installers/main');

$connection->insert($tableName, [
    'name' => 'Lavínia',
    'age'  => 2
]);

$this->endSetup();
