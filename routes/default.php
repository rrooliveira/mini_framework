<?php
$this->get('', function($arg){
    echo 'home';
});

$this->loadRouteFile('noticias');
$this->loadRouteFile('page_not_found');