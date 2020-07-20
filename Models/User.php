<?php

namespace Models;

use System\Model;

class User extends Model
{
    // table define
    public static $table = 'users';

    // fields define
    public static $fields = [
        'login','password', 'token'
    ];    
}