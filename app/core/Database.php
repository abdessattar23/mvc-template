
<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once '../vendor/autoload.php';
require_once '../config/config.php';
$capsule = new Capsule;
$config = require dirname(__DIR__) . '/../config/config.php';
$capsule->addConnection($config );

$capsule->setAsGlobal();
$capsule->bootEloquent();