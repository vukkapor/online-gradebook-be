<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GradebooksController;

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

//register
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/users', 'Auth\RegisterController@backToInd');

//login
Route::post('/login', 'Auth\LoginController@authenticate');

//professors
Route::middleware('jwt')->get('/professors', 'ProfessorsController@index');
Route::middleware('jwt')->post('/professors', 'ProfessorsController@store');
Route::get('/professors/{id}', 'ProfessorsController@show');
Route::middleware('jwt')->get('/professors/{id}/user', 'ProfessorsController@showByUser');

//gradebooks
Route::get('/gradebooks', 'GradebooksController@index');
Route::middleware('jwt')->post('/gradebooks', 'GradebooksController@store');
Route::middleware('jwt')->put('/gradebooks/{id}/edit', 'GradebooksController@update');
Route::get('/gradebooks/{id}', 'GradebooksController@show');
Route::middleware('jwt')->delete('/gradebooks/{id}', 'GradebooksController@destroy');
Route::middleware('jwt')->post('/gradebooks/{id}/comments', 'GradebooksController@addComment');
Route::middleware('jwt')->post('/gradebooks/{id}/students', 'GradebooksController@addStudent');

//comments
Route::middleware('jwt')->delete('/comments/{id}', 'CommentsController@destroy');
