<?php

namespace System;

// Model system file

class Model
{
    public static function connect()
    {
        try {
            $config = include($_SERVER['DOCUMENT_ROOT'] . '/config.php');        
            $conn = 'mysql:host=' . $config['host']
            . ';dbname=' . $config['dbname']
            . ';';
            $pdo = new \PDO($conn,$config['user'], $config['password']);            
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $pdo;
    }
    public static function create($data = [],$model)
    {
        $db = self::connect();
        if($model::$table) {            
            $sql = 'INSERT INTO ' . $model::$table . '(' .
            implode(',',$model::$fields)
            . ') VALUES(' . implode(',', array_map(function(){
                return '?';
            },$data)) . ');';
            
            $preq = $db->prepare($sql);
            $counter = 1;
            $preq->execute(array_values($data));
        }
    }
    public static function where($key, $value, $model)
    {
        $db = self::connect();
        $sql = 'SELECT * FROM ' . $model::$table . ' WHERE '
        . $key .'=\'' . $value . '\';';        
        $query = $db->query($sql);        
        if($query === false) return $query;
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        if(count($data) > 0){                        
            return $data[0];
        }        
        return false;
    }
    public static function all($model)
    {
        $db = self::connect();

        $sql = 'SELECT * FROM ' . $model::$table . ';';

        $query = $db->query($sql);

        return $query !== false ?
            $query->fetchAll(\PDO::FETCH_ASSOC)
        :
            $query;
    }
    public static function update($model,$id, $key, $value)
    {
        $db = self::connect();

        $sql = 'UPDATE ' . $model::$table 
        . ' SET ' . $key . ' = ? WHERE id = '
        . $id . ' ;';

        $query = $db->prepare($sql)
        ->execute([$value]);
    }
    public static function sort($model, $field, $dir = 'ASC')
    {
        $db = self::connect();

        $sql = 'SELECT * FROM ' . $model::$table . ' ORDER BY '
         . $field . ' ' . $dir . ';';                

        $query = $db->query($sql);
        return $query !== false ?
            $query->fetchAll(\PDO::FETCH_ASSOC)
        :
            $query;
    }
}