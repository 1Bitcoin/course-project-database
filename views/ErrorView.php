<?php

require_once(VIEW_PATH . 'View.php');

class ErrorView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/error.tpl.php';
        include ROOT. $pageTpl;
    }
}