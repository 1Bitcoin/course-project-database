<?php

require_once(ROOT . '/repository/score/ScoreRepositoryInterface.php');

use \RedBeanPHP\R as R;

class ScoreRepository implements ScoreRepositoryInterface
{
    private $connection;
    
    public function __construct()
    {
        
    }

    public function getCountScore($searchInfo)
    {
        $target_id = $searchInfo['target_id'];
        $type_score = $searchInfo['type_score'];
        $table = $searchInfo['table'];
        $searchField = $searchInfo['search_field'];

        $nums = R::count($table, $searchField . ' = ? AND type_score = ?', [$target_id, $type_score]);

        return $nums;
    }

    public function getSumScore($infoScore)
    {
        $file_id = $infoScore['file_id'];

        // Получаем сумму оценок от всех пользователей.
        $sum = R::getAll('SELECT SUM(type_score) as total FROM `score_file` WHERE `file_id` = ?', [$file_id]);

        return $sum[0]['total'];
    }

    public function getSumScoreUser($infoScore)
    {
        $user_id_received = $infoScore['user_id_received'];

        // Получаем сумму оценок от всех пользователей.
        $sum = R::getAll('SELECT SUM(type_score) as total FROM `score_user` WHERE `user_id_received` = ?', [$user_id_received]);

        return $sum[0]['total'];
    }

    public function setScoreFile($infoScore)
    {
        $value = $infoScore['value'];
        $user_id = $infoScore['user_id'];
        $file_id = $infoScore['file_id'];

        // Получаем id записи с оценкой к файлу от пользователя, если она есть
        $rows = R::getAll('SELECT `id` FROM `score_file` WHERE `user_id` = ? AND `file_id` = ?', [$user_id, $file_id]);

        // Если запись уже существует - обновляем поле type_score
        // иначе - добавляем новую запись.
        if (isset($rows[0]['id']))
        {
            $idRow = $rows[0]['id'];

            $score = R::load('score_file', $idRow);
            $oldTypeScore = $score->type_score;
            $score->type_score = $value;
            R::store($score);

            return $oldTypeScore;
        }
        else
        {
            $res = R::exec("INSERT INTO score_file (user_id, file_id, type_score) VALUES (?,?,?)", [$user_id, $file_id, $value]);

            return 0;
        }
    }

    public function setScoreUser($infoScore)
    {
        $value = $infoScore['value'];
        $user_id = $infoScore['user_id'];
        $user_id_received = $infoScore['user_id_received'];

        // Получаем id записи с оценкой к пользователю от пользователя, если она есть
        $rows = R::getAll('SELECT `id` FROM `score_user` WHERE `user_id` = ? AND `user_id_received` = ?', [$user_id, $user_id_received]);

        // Если запись уже существует - обновляем поле type_score
        // иначе - добавляем новую запись.
        if (isset($rows[0]['id']))
        {
            $idRow = $rows[0]['id'];

            $score = R::load('score_user', $idRow);
            $oldTypeScore = $score->type_score;
            $score->type_score = $value;
            R::store($score);

            return $oldTypeScore;
        }
        else
        {
            $res = R::exec("INSERT INTO score_user (user_id, user_id_received, type_score) 
                                        VALUES (?,?,?)", [$user_id, $user_id_received, $value]);
            return 0;
        }
    }
}