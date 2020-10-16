<?php
$this->get('noticias', function ($arg) {
    $template = $this->core->loadModule('template');
    $news = $this->core->loadModule('news');

    $array['news'] = $news->getAllNews();

    $template->render('noticias_tpl', $array);
});

$this->get('noticias/{id}', function ($arg) {
    $template = $this->core->loadModule('template');
    $news = $this->core->loadModule('news');

    $array['new'] = $news->getNew($arg['id']);

    $template->render('noticia_tpl', $array);
});

$this->post('noticias', function($arg) {
});