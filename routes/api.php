<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');


Route::group(['middleware' => ['auth:sanctum'], 'namespace' => 'v1', 'prefix' => 'v1'], function () {
    Route::get('/list', 'TaskController@list'); //вывод базы задач
    Route::get('/task', 'TaskController@task'); //вывод уникальной подборки задач для пользователя
    Route::post('/task/success/{task}', 'TaskController@success'); //пометка выполнения задач
    Route::put('/task/change/{task}', 'TaskController@change'); //замена задания на другое...

    Route::get('/for-user', 'TaskController@taskToUser'); //endpoint для формирования уникальной подборки задач
    Route::get('/fake', 'TaskController@fake'); //enpoint для заполнения базы задач
});



