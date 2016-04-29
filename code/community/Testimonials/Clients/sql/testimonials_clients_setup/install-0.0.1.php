<?php
$this->startSetup();


$table = new Varien_Db_Ddl_Table();

$table->setName($this->getTable('testimonials_clients/client'));


$table->addColumn(
    'entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER, 
    10, 
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$table->addColumn(
    'created_at', 
    Varien_Db_Ddl_Table::TYPE_DATETIME, 
    null, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'updated_at', 
    Varien_Db_Ddl_Table::TYPE_DATETIME, 
    null, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'name', 
    Varien_Db_Ddl_Table::TYPE_VARCHAR, 
    255, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'location', 
    Varien_Db_Ddl_Table::TYPE_VARCHAR, 
    255, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'description', 
    Varien_Db_Ddl_Table::TYPE_TEXT, 
    null, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'image', 
    Varien_Db_Ddl_Table::TYPE_VARCHAR, 
	255,
    null, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'visibility', 
    Varien_Db_Ddl_Table::TYPE_BOOLEAN, 
    null, 
    array(
        'nullable' => false,
    )
);

/**
 * A couple of important lines that are often missed.
 */
$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');

/**
 * Create the table!
 */
$this->getConnection()->createTable($table);

$this->endSetup();
