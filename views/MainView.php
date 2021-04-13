<?php

require_once(VIEW_PATH . 'View.php');

class MainView extends View
{
    public function render($pageData) 
    {
        header("Location: https://iu7.ru");
    }
}