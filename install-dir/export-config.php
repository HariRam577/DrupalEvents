<?php

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

$autoloader = require_once 'vendor/autoload.php';
$kernel = DrupalKernel::createFromRequest(Request::createFromGlobals(), $autoloader, 'prod');
$kernel->boot();

$config_storage = \Drupal::service('config.storage.sync');
$config_manager = \Drupal::service('config.manager');

foreach ($config_manager->getConfigFactory()->listAll() as $name) {
  $data = $config_manager->getConfigFactory()->get($name)->getRawData();
  $config_storage->write($name, $data);
}

echo "Configuration exported successfully!\n";