<?php
/**
 * @var MagedIn_Affiliates_Model_Resource_Setup $this
 * @var Magento_Db_Adapter_Pdo_Mysql            $conn
 */

$this->startSetup();

$conn->addColumn($this->getTable('magedin_affiliates/order'), 'commission_status', [
    'nullable' => true,
    'unsigned' => true,
    'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'   => 20,
    'comment'  => 'Affiliate Order Status',
    'after'    => 'id',
]);

$this->endSetup();
