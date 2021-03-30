<?php

class LoginView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/login.tpl.php';
        include ROOT. $pageTpl;
    }
}