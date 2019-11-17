<?php

use Doctrine\ORM\Tools\Setup;
require_once "vendor/autoload.php";
require_once "src/config.php";
//entity path
$entityPath = array("src/model");
$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration($entityPath, $isDevMode);

// database configuration parameters
$dbParams = array(
	'driver'  => 'pdo_mysql',
	'user'   => 'euronaval2018',
	'password' => 'M3VlH7RK6qU',//'emk4y2JHT2BQcQQ',
	'dbname'  => 'euronaval2018',
		'host'=>'10.75.2.10',//'10.75.2.10',
    'charset'  => 'utf8',
    'driverOptions' => array(
        1002 => 'SET NAMES utf8'
    )
);

// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
