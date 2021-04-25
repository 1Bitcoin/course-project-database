<?php

require_once(VIEW_PATH . 'View.php');

class IndexView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/main.tpl.php';
        include ROOT . $pageTpl;
    }

    public function renderGuestPage($pageData) 
    {
        $pageTpl = '/public/main-guest.tpl.php';
        include ROOT . $pageTpl;
    }
}