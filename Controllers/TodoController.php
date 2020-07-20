<?php

namespace Controllers;

use System\View;
use System\Controller;

use Middlewares\IsAdmin;
use Models\Todo;

class TodoController extends Controller
{
    // middleware define
    public function __construct()
    {
        $this->middleware('isAdmin', '\Middlewares\IsAdmin::middleware');
    }
    // create a new todo
    public function createTodo($user = false)
    {
        // validation

        $errors = [];

        if(isset($_POST['username']) 
        && isset($_POST['email'])
        && isset($_POST['body'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $body = $_POST['body'];
            
            if(strlen($username) < 1 || strlen($email) < 1)
            $errors[] = 'Fields should not be empty';
            $emailValidate = preg_match("/[0-9a-z]+@[a-z]/", $email);

            if($emailValidate == 0 || $emailValidate == false)
            $errors[] = 'Incorrect email';
        }

        if(!empty($errors)) {
            setcookie('error',$errors[0],time() + 5);

            return header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        // make a new todo
        Todo::create($_POST, Todo::class);
        setcookie('message','Your todo created successfully!',time() + 5);

        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    // edit an existing todo
    public function editTodo($user = false)
    {        
        if(isset($_POST['body']) && $user != false && isset($_POST['todo_id'])) {
            $todo = Todo::where('id', $_POST['todo_id'], Todo::class);
            Todo::update(Todo::class, $_POST['todo_id'], 'body', $_POST['body']);
            Todo::update(Todo::class, $_POST['todo_id'], 'status',
                isset($_POST['status']) ? 'completed' : null);
            
            if($todo['modified'] == 0 && $_POST['body'] != $todo['body'])
                Todo::update(Todo::class, $_POST['todo_id'], 'modified',1);
                return header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/to-login');
    }
    // sorting by field
    public function sort($user = false)
    {        
        $by = $_GET['by'];
        $dir = $_GET['dir'];
        $todos = [];
        
        switch($by) {
            case 'username':
                $todos = Todo::sort(Todo::class, 'username', $dir);
            break;
            case 'email':
                $todos = Todo::sort(Todo::class, 'email', $dir);
            break;
            case 'status':
                $todos = Todo::sort(Todo::class, 'status', $dir);
            break;
        }

        $result = array_chunk($todos,3);
        if(count($result[count($result) - 1]) == 3) $result[] = [];

        return View::render('home', [
            'todos' => $result,
            'user' => $user
        ]);
    }
}