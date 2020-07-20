<?php

namespace System;

use System\View;
use Models\News;
use Models\Todo;

// Controller System file

class Controller
{
    public $middlewares = [];

    public function middleware(string $middleware, $callback)
    {
        $this->middlewares[$middleware] = $callback;
    }
}