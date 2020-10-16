<?php

class Template
{
    private function __construct(){}

    public static function getInstance()
    {
        static $instance = null;

        if($instance === null){
            $instance = new Template();
        }
        return $instance;
    }

    public function render($template, $data = array())
    {
        if(file_exists('templates/' . $template . '.phtml')) {
            require_once 'templates/' . $template . '.phtml';
        }
    }
}