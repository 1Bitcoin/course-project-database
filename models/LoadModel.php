<?php

require_once(MODEL_PATH . 'Model.php');

class LoadModel extends Model 
{
    public function load($dataFile)
    {
        $messages = '';

        if (isset($dataFile['file']) && $dataFile['file']['error'] === UPLOAD_ERR_OK)
        {
            // get details of the uploaded file
            $fileTmpPath = $dataFile['file']['tmp_name'];
            $fileName = $dataFile['file']['name'];
            $fileSize = $dataFile['file']['size'];
            $fileType = $dataFile['file']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            // check if file has one of the following extensions
            $allowedfileExtensions = array('html', 'php', 'js');

            if (!in_array($fileExtension, $allowedfileExtensions))
            {
                // directory in which the uploaded file will be moved
                $uploadFileDir = '/var/www/course-project-database/uploaded_files/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) 
                {
                    $message ='File is successfully uploaded.';
                }
                else 
                {
                    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
            }
            else
            {
                $message = 'Upload failed. Banned file types: ' . implode(',', $allowedfileExtensions);
            }
        }
        else
        {
            $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $dataFile['file']['error'];
        }
    }  
}



