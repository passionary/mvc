<?php

namespace Routes;

use System\Route;

// routes register file

Route::register('/login','LoginController@login','POST');
Route::register('/logout','HomeController@logout','GET');
Route::register('/to-login','LoginController@showLogin','GET');
Route::register('/','HomeController@index','GET');
Route::register('/create-todo','TodoController@createTodo', 'POST');
Route::register('/edit-todo','TodoController@editTodo','POST');
Route::register('/sort','TodoController@sort','GET');