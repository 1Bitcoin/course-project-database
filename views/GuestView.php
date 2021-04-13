<?php

require_once(VIEW_PATH . 'View.php');

class GuestView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/main-guest.tpl.php';
        include ROOT . $pageTpl;
    }
}