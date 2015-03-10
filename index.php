<?php 

require_once('aplication/config/config.php');
require_once('aplication/config/database.php');
require_once('system/autoload.php');


$app = new app($config, $database);
$app->run();
