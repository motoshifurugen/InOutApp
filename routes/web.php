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

Route::get('/', 'AllArticleController@index');

Route::resource('event', 'EventController');

Auth::routes();

Route::resource('recruit', 'RecruitController');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('balances', 'BalanceController');

Route::resource('pokemons', 'PokemonController');

Route::resource('allpokemons', 'AllPokemonController');

// Route::post('/login', 'UserController@login');
// Route::middleware('auth:sanctum')->post('/logout', 'UserController@logout');
// Route::middleware('auth:sanctum')->get('/user', 'UserController@user');

Route::resource('articles', 'ArticleController');

Route::resource('allarticles', 'AllArticleController');

