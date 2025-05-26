<?php
// config_db.php
return [
    'dsn' => 'mysql:host=dataepis.uandina.pe:49206;dbname=BDProductos;charset=utf8',
    'user' => 'luissalas',
    'pass' => 'luissalas2025',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];
