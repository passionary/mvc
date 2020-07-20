<?php

namespace Controllers;

use Models\User;
use Models\Todo;
use System\View;

class LoginController
{
    // login method
    public function login()
    {        
        if(!isset($_POST['login']) || !$_POST['login']
         && !isset($_POST['password']) || !$_POST['password']) {
            setcookie('error','You entered incorrect data',time() + 5);
            return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/to-login');
        }
        $user = User::where('login', $_POST['login'], User::class);        
        if(!$user || !isset($user)){
            setcookie('error','You entered invalid access credentials',time() + 5);
            return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/to-login');
        }
        if($user) {
            if(password_verify($_POST['password'],$user['password'])) {                
                $token = $user['password'] . '123';
                User::update(User::class, $user['id'], 'token', $token);
                setcookie('token',$token,time() + 1800);
                setcookie('message','you signed in successfully',time() + 5);
                header('Location: http://' . $_SERVER['SERVER_NAME'] . '/');
                return View::render('home',[
                    'user' => $user,
                    'todos' => Todo::all(\Models\Todo::class)
                ]);
            }            
            setcookie('error','You entered invalid access credentials',time() + 5);
            return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/to-login');            
        }        
    }
    // show login view
    public function showLogin()
    {        
        return View::render('login');
    }    
}