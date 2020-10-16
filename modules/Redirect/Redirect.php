<?php

class Redirect
{
    private function __construct(){}

    public static function getInstance()
    {
        static $instance = null;

        if($instance === null){
            $instance = new Redirect();
        }
        return $instance;
    }

    public function go($pagina)
    {
        header("Location: ./{$pagina}");
    }
}