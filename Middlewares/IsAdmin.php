<?php

namespace Middlewares;

use Models\User;

// middlewares

class IsAdmin 
{
    public static function middleware ()
    {
        if(!isset($_COOKIE['token'])) {
            return false;
        }
        $user = User::where('token',$_COOKIE['token'], User::class);
        if(null!=($user)) {
            return $user;
        };
        return false;
    }
}