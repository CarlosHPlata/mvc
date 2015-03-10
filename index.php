<?php 

require_once('aplication/config/config.php');
require_once('aplication/config/database.php');
require_once('system/autoload.php');

define('BASE', $config['base_url']);

$app = new app($config, $database);
$app->run();
