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

$router->get('/key', function (){
    return Str::random(60);
});

$router->get('/nyoba', function(){

    $data = Str::of('foo bar baz')->explode(' ');

    return response()->json($data);
});
$router->post('/register', 'UserController@register');
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
   $router->post('register', 'AuthController@register');

     // Matches "/api/login
    $router->post('/login', 'AuthController@login');
});

$router->get('/user', 'UserController@allshow');

$router->get('/user/{id}', 'UserController@oneshow');

$router->post('/user/{id}/createtask', 'TaskController@createTask');

$router->get('/task', 'TaskController@showAllTask');
$router->get('/user/{id}/task', 'TaskController@showTaskUser');

$router->get('/absent', 'PresentController@index');

$router->post('/absent/checkin', 'PresentController@checkIn');


