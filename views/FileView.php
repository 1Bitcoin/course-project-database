<?php

require_once(VIEW_PATH . 'View.php');

class FileView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/list.tpl.php';
        include ROOT . $pageTpl;
    }

    public function filePage($pageData) 
    {
        $pageTpl = '/public/file.tpl.php';
        include ROOT . $pageTpl;
    }
}