<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/5/2015
 * Time: 2:46 AM
 */

resolve('router')->collect(require_once(APPLICATION_PATH.'/Routes.php'));

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = resolve('configuration')->sf2()->doctrine['devmode'];
$config = Setup::createAnnotationMetadataConfiguration(array(APPLICATION_PATH."/Configuration/Doctrine/src"), $isDevMode);

$conn = resolve('configuration')->sf2()->doctrine['connection'];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);