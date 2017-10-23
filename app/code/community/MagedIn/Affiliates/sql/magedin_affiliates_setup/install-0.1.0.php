<?php

/**
 * @var MagedIn_Affiliates_Model_Resource_Setup $this
 * @var Magento_Db_Adapter_Pdo_Mysql            $conn
 */

/**
 * Tip the first table is installed via Magento default installation process.
 * To understand the other table installation process please see the trait MagedIn_Affiliates_Trait_Resource_Setup.
 */

$this->startSetup();

# ----------------------------------------------------------------------------------------------------------------------

/** @var string $tableName */
$tableName = $this->getTable('magedin_affiliates/entity');

$conn->dropTable($tableName);

/** @var Varien_Db_Ddl_Table $table */
$table = $conn->newTable($tableName);
$table->addColumn('id', $table::TYPE_INTEGER, 10, [
    'identity' => true,
    'unsigned' => true,
    'primary'  => true,
    'nullable' => false,
])->addColumn('name', $table::TYPE_VARCHAR, 255, [
    'nullable' => false,
])->addColumn('description', $table::TYPE_TEXT, null, [
    'nullable' => true,
])->addColumn('comment', $table::TYPE_TEXT, null, [
    'nullable' => true,
])->addColumn('sales_commission_type', $table::TYPE_INTEGER, 2, [
    'nullable' => false,
])->addColumn('sales_commission_percent', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('sales_commission_fixed', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('created_at', $table::TYPE_DATETIME, null, [
    'nullable' => true,
    'unsigned' => true,
])->addColumn('updated_at', $table::TYPE_DATETIME, null, [
    'nullable' => true,
    'unsigned' => true,
]);

/**
 * This is using the Magento default methods to create an index.
 */
$conn->createTable($table);

$fields    = ['name', 'sales_commission_type'];
$indexName = $this->getIdxName($tableName, $fields, $this::INDEX_TYPE_INDEX);
$conn->addIndex($tableName, $indexName, $fields, $this::INDEX_TYPE_INDEX);

# ----------------------------------------------------------------------------------------------------------------------

/**
 * For more information you can check out the trait MagedIn_Affiliates_Trait_Resource_Setup.
 */

/** @var Varien_Db_Ddl_Table $table */
$table = $this->newTable($this->getTable('magedin_affiliates/order'));

$table->addColumn('affiliate_id', $table::TYPE_INTEGER, null, [
    'primary'  => true,
    'nullable' => false,
])->addColumn('order_id', $table::TYPE_INTEGER, null, [
    'nullable' => false,
])->addColumn('base_subtotal', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('subtotal', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('base_discount_amount', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('discount_amount', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('base_grand_total', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('grand_total', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('order_commission_type', $table::TYPE_INTEGER, 2, [
    'nullable' => false,
])->addColumn('order_commission_delta', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('base_commission_amount', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])->addColumn('commission_amount', $table::TYPE_DECIMAL, '12,4', [
    'nullable' => true,
    'default'  => '0.0000',
])
;

$this->addTimestamps($table);
$conn->createTable($table);

$this->addIndexes(['affiliate_id', 'order_id'], $table, $this::INDEX_TYPE_INDEX);

$this->addForeignKey($table, 'affiliate_id', 'magedin_affiliates/entity', 'id');
$this->addForeignKey($table, 'order_id', 'sales/order', 'entity_id');

#-----------------------------------------------------------------------------------------------------------------------

/**
 * For more information you can check out the trait MagedIn_Affiliates_Trait_Resource_Setup.
 */

/** @var Varien_Db_Ddl_Table $table */
$table = $this->newTable($this->getTable('magedin_affiliates/balance'))
    ->addColumn('affiliate_id', $table::TYPE_INTEGER, null, [
        'nullable' => false,
    ])->addColumn('base_balance_amount', $table::TYPE_DECIMAL, '12,4', [
        'nullable' => true,
        'default'  => '0.0000',
    ])->addColumn('balance_amount', $table::TYPE_DECIMAL, '12,4', [
        'nullable' => true,
        'default'  => '0.0000',
    ])
;

$this->addTimestamps($table);
$conn->createTable($table);

$this->addIndexes(['affiliate_id'], $table, $this::INDEX_TYPE_INDEX);

$this->addForeignKey($table, 'affiliate_id', 'magedin_affiliates/entity', 'id');

#-----------------------------------------------------------------------------------------------------------------------

/**
 * For more information you can check out the trait MagedIn_Affiliates_Trait_Resource_Setup.
 */

/** @var Varien_Db_Ddl_Table $table */
$table = $this->newTable($this->getTable('magedin_affiliates/history'))
    ->addColumn('affiliate_id', $table::TYPE_INTEGER, null, [
        'primary'  => true,
        'nullable' => false,
    ])
    ->addColumn('balance_id', $table::TYPE_INTEGER, null, [
        'nullable' => false,
    ])
    ->addColumn('action', $table::TYPE_INTEGER, 2, [
        'nullable' => false,
    ])
    ->addColumn('admin_user_id', $table::TYPE_INTEGER, 10, [
        'nullable' => true,
    ])
    ->addColumn('comment', $table::TYPE_TEXT, null, [
        'nullable' => true,
    ])
    ->addColumn('balance_amount', $table::TYPE_DECIMAL, '12,4', [
        'nullable' => true,
        'default'  => '0.0000',
    ])
;

$this->addTimestamps($table);
$conn->createTable($table);

$this->addIndexes(['affiliate_id', 'balance_id'], $table, $this::INDEX_TYPE_INDEX);

$this->addForeignKey($table, 'affiliate_id', 'magedin_affiliates/entity',  'id');
$this->addForeignKey($table, 'balance_id',   'magedin_affiliates/balance', 'id');

#-----------------------------------------------------------------------------------------------------------------------

/**
 * For more information you can check out the trait MagedIn_Affiliates_Trait_Resource_Setup.
 */

$this->getConnection()->addColumn($this->getTable('sales/order'), 'affiliate_id', [
    'nullable' => true,
    'unsigned' => true,
    'type'     => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length'   => 10,
    'comment'  => 'Associated Affiliate ID.',
]);

$this->addIndexes('affiliate_id', 'sales/order', $this::INDEX_TYPE_INDEX);
$this->addForeignKey('sales/order', 'affiliate_id', 'magedin_affiliates/entity', 'id');

#-----------------------------------------------------------------------------------------------------------------------

/**
 * For more information you can check out the trait MagedIn_Affiliates_Trait_Resource_Setup.
 */

$this->getConnection()->addColumn($this->getTable('sales/quote'), 'affiliate_id', [
    'nullable' => true,
    'unsigned' => true,
    'type'     => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length'   => 10,
    'comment'  => 'Associated Affiliate ID.',
]);

$this->addIndexes('affiliate_id', 'sales/quote', $this::INDEX_TYPE_INDEX);
$this->addForeignKey('sales/quote', 'affiliate_id', 'magedin_affiliates/entity', 'id');

#-----------------------------------------------------------------------------------------------------------------------

$this->endSetup();
