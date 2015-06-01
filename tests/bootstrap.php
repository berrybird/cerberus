<?php

date_default_timezone_set('UTC');

$loader = require realpath(__DIR__ . '/../vendor/autoload.php');

$loader->addPsr4('Berrybird\\Cerberus\\', __DIR__ . '/src');
