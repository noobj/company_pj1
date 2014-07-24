<?php

require_once 'vendor/autoload.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__.'/src'], $isDevMode);

// database configuration parameters
$conn = [
   'driver' => 'pdo_mysql',
   'user'   => 'root',
   'password' => '12345678',
   'host' => 'localhost',
   'dbname' => 'test',
];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
