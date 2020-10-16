<?php
$this->get('page_not_found', function ($arg) {
    $template = $this->core->loadModule('template');
    $template->render('page_not_found_tpl', []);
});