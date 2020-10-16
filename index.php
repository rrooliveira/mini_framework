<?php
session_start();
require_once('config.php');

spl_autoload_register(function ($class){
    if(file_exists('modules/'. $class . '/' . $class . '.php')){
        require_once 'modules/'. $class . '/' . $class . '.php';
    }
});

Core::getInstance()->run($config);


