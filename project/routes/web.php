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

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('/users/register', 'AuthController@register');

    $router->post('/users/login', 'AuthController@authenticate');

    $router->get('/lottery_games', 'LotteryGameController@show');

    $router->get('/lottery_game_matches', 'LotteryGameMatchController@show');

    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->put('/users/{id}', 'UserController@update');

        $router->delete('/users/{id}', 'UserController@delete');

        $router->post('/lottery_game_match_users', 'LotteryGameMatchUserController@create');

        $router->group(['middleware' => 'admin'], function () use ($router) {

            $router->post('/lottery_game_matches', 'LotteryGameMatchController@create');

            $router->put('/lottery_game_matches/{id}', 'LotteryGameMatchController@update');

            $router->get('/users', 'UserController@show');
        });
    });
});
