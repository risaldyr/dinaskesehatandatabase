<?php

use illuminate\support\Str;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/key', function () {
    return Str::random(60);
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'UserController@register');
    // Matches "/api/login
    $router->post('/login', 'AuthController@login');
});


// Admin Route
$router->group(['middleware' => ['auth', 'role:admin']], function () use ($router) {
    $router->get('/users', 'UserController@allshow');
    $router->get('/user/{id}', 'UserController@oneshow');
    $router->get('/task', 'TaskController@showAllTask');
    $router->get('/user/{id}/task', 'TaskController@showTaskUser');
});


// User Route
$router->group(['middleware' => ['auth', 'rolemember:user']], function () use ($router) {
    $router->post('/user/createtask', 'TaskController@createTask');
    $router->get('/absent', 'PresentController@index');
    $router->post('/absent/checkin', 'PresentController@checkin');
});

$router->group(['middleware' => ['auth', 'rolemember:host']], function() use ($router){
    $router->get('/qrcode', 'HostController@showQrcode');
});



