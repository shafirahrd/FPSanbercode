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

Route::get('/', 'UserController@index');
Route::resource('user', 'UserController');

Route::resource('question', 'QuestionController');
Route::get('question/sortby/{param}', 'QuestionController@sortedIndex');

Route::resource('answer', 'AnswerController');
Route::post('answer/{id}', 'AnswerController@store');
Route::post('comment/{id}', 'QuestionCommentController@store');

Route::post('question/comment/{id}', 'QuestionCommentController@store');
Route::post('answer/comment/{id}', 'AnswerCommentController@store');
Route::post('/question/vote', 'QuestionController@vote');
Route::post('/answer/vote/store', 'AnswerController@vote');

Route::get('/login', 'UserController@login');
Route::post('/loginPost', 'UserController@loginPost');
Route::get('/register', 'UserController@register');
Route::get('/logout', 'UserController@logout');

Route::post('/question/{question}/bestanswer/{answer}', 'QuestionController@bestAnswer');

Route::get('/test', function(){ return view('test'); });