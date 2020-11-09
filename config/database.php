<?php

$dbManager = new \Illuminate\Database\Capsule\Manager;

$dbManager->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASSWORD'),
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_bin',
    'prefix'    => '',
]);

$dbManager->setAsGlobal();
$dbManager->bootEloquent();