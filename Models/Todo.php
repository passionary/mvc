<?php

namespace Models;

use System\Model;

class Todo extends Model
{
    // table define
    public static $table = 'todos';

    // fields define
    public static $fields = [
        'username', 'email', 'body'
    ];    
}