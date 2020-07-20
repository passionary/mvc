<?php

namespace System;

// System application file

class App
{
    public static function init()
    {
        // include routes from \Routes\index.php

        include_once $_SERVER['DOCUMENT_ROOT'] . '/Routes/index.php';
        
        $url = $_SERVER['REQUEST_URI'];
        
        preg_match('/\/[^\/?]*(?=\?*)/', $url, $routes);
        
        $route = count($routes) > 0 ? $routes[0] : false;

        if(Route::exists($route)) {
            $handlerArray = Route::$routes[$route];
            $controller = 'Controllers\\' . $handlerArray[0];
            $action = $handlerArray[1];

            // validation

            if (!class_exists($controller)) {
                throw new \ErrorException('Controller does not exist');
            }
                        
            $curController = new $controller;
            
            if (!method_exists($curController, $action)) {
                throw new \ErrorException('Action does not exist');
            }                        
            if($handlerArray[2] !== $_SERVER["REQUEST_METHOD"]){
                throw new \Error('Request method not allow for this route');
            }

            // call middlewares

            if(!empty($curController->middlewares)) {
                foreach($curController->middlewares as $mware) {
                    $data = $mware();
                }
                return $curController->$action($data);
            }
            // call controller action
            
            $curController->$action();
        };
    }
}