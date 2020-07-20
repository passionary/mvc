<?php

namespace Controllers;

use System\View;
use System\Controller;

use Models\User;
use Models\Todo;

class HomeController extends Controller
{
    // middleware define
    public function __construct()
    {
        $this->middleware('isAdmin', '\Middlewares\IsAdmin::middleware');
    }
    // logout action need a user model
    public function logout($user = false)
    {
        if($user != false && isset($_COOKIE['token'])) {
            User::update(User::class, $user['id'], 'token', null);   
            unset($_COOKIE['token']);
            setcookie('token',null, -1);

            return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/to-login');
        }
        return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/to-login');
    }
    // start page
    public function index($user = false)
    {
        $todos = Todo::all(Todo::class);

        if(empty($todos)) {
            View::render('home',[
                'todos' => [],
                'user' => $user
            ]);
            return;
        }
        $result = array_chunk($todos,3);

        if(count($result[count($result) - 1]) == 3) $result[] = [];

        View::render('home',[
            'todos' => $result,
            'user' => $user
        ]);
    }    
}