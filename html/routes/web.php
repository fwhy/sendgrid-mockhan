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

$router->post('v3/mail/send', ['uses' => 'V3\Mail\SendController', 'as' => 'mail_api']);

$router->get('/', ['uses' => 'DashboardController@index']);
$router->get('/{personalizationId:[0-9]+}', ['uses' => 'DashboardController@show']);
$router->get('/download/{attachmentId}', ['uses' => 'DashboardController@download']);
$router->get('/licenses', ['uses' => 'LicensesController']);
