<?php

require_once(MODEL_PATH . 'Model.php');

class LoadModel extends Model 
{
    public function __construct(FileRepository $fileRepository) 
    {
        $this->repo = $fileRepository;
    }
    
    public function loadFile($dataFile)
    {
        $messages = '';
        $infoFile = array();

        if (isset($dataFile['file']) && $dataFile['file']['error'] === UPLOAD_ERR_OK)
        {
            // Получаем информацию о загруженном файле
            $fileTmpPath = $dataFile['file']['tmp_name'];
            $fileName = $dataFile['file']['name'];
            $fileSize = $dataFile['file']['size'];
            $fileType = $dataFile['file']['type'];
            $fileUser = $dataFile['user_id'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Изменяем имя файла для хранения
            $newFileName = md5(time() . $fileName);

            // Директория загрузки файлов
            $destPath = UPLOAD_PATH . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) 
            {
                $message ='Файл успешно загружен.';
            }
            else 
            {
                $message = 'Возникла проблема с записью файла в директорию. На директории должны быть права записи.';
            }

            $infoFile['name'] = $fileName; 
            $infoFile['size'] = $fileSize; 
            $infoFile['type'] = $fileType; 
            $infoFile['hash'] = $newFileName;
            $infoFile['user_id'] = $fileUser;
        }
        else
        {
            $message = 'Ошибка во время загрузки файла. Изучите возникшую ошибку.<br>';
            $message .= 'Error:' . $dataFile['file']['error'];
            print_r($message);
        }

        return $infoFile;
    }  

    public function addFile($infoFile)
    {
        if (isset($infoFile['name']))
        {
            $this->repo->addFile($infoFile);  
        } 
    }
}



