<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->get('/productos', 'ProductosController@index');
$router->get('/productos/{producto}', 'ProductosController@show');
$router->post('/productos', 'ProductosController@store');
$router->put('/productos/{producto}', 'ProductosController@update');
$router->patch('/productos/{producto}', 'ProductosController@update');
$router->delete('/productos/{producto}', 'ProductosController@destroy');



/**
 * Routers Protected by user credentials
 */
/* $router->group(['middleware'=>'auth:api'], function() use ($router){
  $router->get('users/me', 'UserController@me');
}); */
