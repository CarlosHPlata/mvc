<?php 
define("APP_BASE", $config['aplication_folder']);

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    define("PUBLIC_FOLDER", "https://".$config['base_url'].'/'.$config['public_folder'].'/');
} else {
    define("PUBLIC_FOLDER", "http://".$config['base_url'].'/'.$config['public_folder'].'/');
}


spl_autoload_extensions('.php');

spl_autoload_register(
    function ($className) {
        if (file_exists(APP_BASE."/controller/$className.php")) {
            include_once APP_BASE."/controller/$className.php";
        }
        if (file_exists(APP_BASE."/model/$className.php")) {
            include_once APP_BASE."/model/$className.php";
        }
        if (file_exists("system/core/$className.php")) {
            include_once "system/core/$className.php";
        }
        if (file_exists("system/database/$className.php")){
            include_once "system/database/$className.php";
        }
        if (file_exists("system/database/concreteFactories/$className.php")){
            include_once "system/database/concreteFactories/$className.php";
        }
        if (file_exists("system/database/concreteConnections/$className.php")){
            include_once "system/database/concreteConnections/$className.php";
        }
        if (file_exists("system/config/$className.php")){
            include_once "system/config/$className.php";
        }
        if (file_exists("system/error/$className.php")){
            include_once "system/error/$className.php";
        }
    }
);