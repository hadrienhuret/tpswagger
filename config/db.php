<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=bdddevis',
    'username' => 'root',
    'password' => 'tpswagger',
    'attributes' => [PDO::ATTR_CASE => PDO::CASE_LOWER],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
