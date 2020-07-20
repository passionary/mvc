<?php

namespace System;

// View system file

class View
{
    public static function render($path, $data = [])
    {        
        $dirPath = __DIR__ . '/../Views/' . $path . '.php';
        // check file existing by path   
        if (!file_exists($dirPath)) {
            throw new \ErrorException('View not found');
        }
        
        // data passing to views

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
                
        include $dirPath;
    }
}