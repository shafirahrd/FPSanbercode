<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'Controller@index');
Route::get('/login', 'Controller@login');
Route::get('/register', 'Controller@register');
// Route::get('/question', 'QuestionController@index');
// Route::get('/question/{id}', 'AnswerController@index');

Route::get('/question/create', 'Controller@createquestion');
Route::post('/question/id', 'Controller@index');
Route::get('/question/id/edit', 'Controller@editquestion');
Route::put('/question/update', 'Controller@indexanswer');

Route::delete('/question/id/delete', 'Controller@index');

Route::get('/answer', 'Controller@indexanswer');
// Route::get('/answer/{id}/create', 'AnswerController@create');
Route::post('/answer/id', 'Controller@indexanswer');
