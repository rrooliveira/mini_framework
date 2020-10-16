<?php

class Core
{
    private $config;

    private function __construct(){}

    public static function getInstance()
    {
        static $instance = null;

        if($instance === null){
            $instance = new Core();
        }
        return $instance;
    }

    public function run($config)
    {
        $this->config = $config;
        $this->loadModule('router')->load()->match();
    }

    public function getConfig($name)
    {
        return $this->config[$name];
    }

    public function loadModule($moduleName)
    {
        try {
            $moduleName = ucfirst(strtolower($moduleName));
            return $moduleName::getInstance();
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}