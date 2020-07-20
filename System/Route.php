<?php

namespace System;

// Route system file

class Route
{
    public static $routes = [];
    
    public static function register($route, $handler, $method)
    {   
        $match = preg_match('/(?<=[\\w])@(?=[\\w])/', $handler, $matches);        
        if($match === 0 || $match == false) throw new \ParseError('no valid handler');
        $handleArray = array_merge(explode('@', $handler),[$method]);
        self::$routes[$route] = $handleArray;
    }
    public static function exists($route)
    {
        return array_key_exists($route, self::$routes);
    }
}