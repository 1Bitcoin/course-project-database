<?php

require_once(COMPONENT_BASE . 'View.php');

class ListView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/list.tpl.php';
        include ROOT . $pageTpl;
    }
}