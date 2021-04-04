<?php

require_once(VIEW_PATH . 'View.php');

class FileView extends View
{
    public function render($pageData) 
    {
        $pageTpl = '/public/list.tpl.php';
        readfile(ROOT . $pageTpl);
    }
}