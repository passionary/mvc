<?php

namespace System;

// Route system file

class Route
{
    public static $routes = [];
    
    public static function register(string $route, string $handler, string $method)
    {   
        $match = preg_match('/(?<=[\\w])@(?=[\\w])/', $handler, $matches);        
        if($match === 0 || $match == false) throw new \ParseError('no valid handler');
        $handleArray = array_merge(explode('@', $handler),[$method]);
        self::$routes[$route] = $handleArray;
    }
    public static function exists(string $route)
    {
        return array_key_exists($route, self::$routes);
    }
}