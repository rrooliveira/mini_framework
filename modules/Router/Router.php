<?php

class Router
{
    private $core;
    private $get;
    private $post;
    
    private function __construct(){}

    public static function getInstance()
    {
        static $instance = null;

        if($instance === null){
            $instance = new Router();
        }
        return $instance;
    }

    public function load()
    {
        $this->core = Core::getInstance();
        $this->loadRouteFile('default');

        return $this;
    }

    public function loadRouteFile($file)
    {
        if(file_exists('routes/' . $file . '.php')) {
            require_once 'routes/' . $file . '.php';
        }
    }

    public function match()
    {
        $url = ((isset($_GET['url'])) ? $_GET['url'] : '');
        $url_encontrada = false;

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
            default:
                $type = $this->get;
                break;
            case 'POST':
                $type = $this->post;
                break;
        }

        //Loop em todos os routes
        foreach($type as $pt => $func) {
            $pattern = preg_replace('(\{[a-z0-9]{0,}\})', '([a-z0-9]{0,})', $pt);

            //Faz o match de URL
            if(preg_match('#^('.$pattern.')*$#i', $url, $matches) === 1) {
                $url_encontrada = true;
                array_shift($matches);
                array_shift($matches);

                //Pega todos os argumentos para associar
                $itens = [];
                if(preg_match_all('(\{[a-z0-9]{0,}\})', $pt, $m)) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }

                //Faz a associação
                $arg = [];
                foreach($matches as $key => $match) {
                    $arg[$itens[$key]] = $match;
                }
                $func($arg);
                break;
            }
        }
        if($url_encontrada == false) {
            $redirect = Redirect::getInstance();
            $redirect->go('page_not_found');
        }
    }

    public function get($pattern, $function)
    {
        $this->get[$pattern] = $function;
    }

    public function post($pattern, $function)
    {
        $this->post[$pattern] = $function;

    }
}