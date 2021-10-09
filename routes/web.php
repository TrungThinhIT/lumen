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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['namespace' => 'Api'], function () use ($router) {
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('', 'UsersController@index');
        $router->get('/{id}', 'UsersController@show');
        $router->post('', 'UsersController@store');
        $router->put('/{id}', 'UsersController@update');
        $router->delete('/{id}', 'UsersController@destroy');
    });

    $router->group(['prefix' => 'addresses'], function () use ($router) {
        $router->get('', 'AddressesController@index');
        $router->get('/{id}', 'AddressesController@show');
        $router->post('', 'AddressesController@store');
        $router->put('/{id}', 'AddressesController@update');
        $router->delete('/{id}', 'AddressesController@destroy');
    });
});
