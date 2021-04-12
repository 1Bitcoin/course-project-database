<?php

require_once(VIEW_PATH . 'View.php');

class RegisterView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/register.tpl.php';
        include ROOT. $pageTpl;
    }
}