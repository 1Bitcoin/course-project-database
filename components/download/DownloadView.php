<?php

require_once(COMPONENT_BASE . 'View.php');

class DownloadView extends View
{
    public function render($pageData) 
    {
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $pageData['name'] . '"');
        set_time_limit(0);
        $file = @fopen(UPLOAD_PATH . $pageData['hash'], "rb");

        while (!feof($file)) 
        {
            print(@fread($file, 1024*8));
            ob_flush();
            flush();
        }
    }
}