<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('/', 'IndexController', [
    'only' => ['index'],
    'names' => ['index' => 'home']
]);

Route::get('/articles/cat/{alias}', 'ArticleController@articlesCat')->name('articlesCat');
//Route::resource('/categories', 'CategoryController', [
//    'parameters' => [
//        'categories' => 'alias'
//
//    ]]);
Route::resource('/articles', 'ArticleController', [
    'parameters' => [
        'articles' => 'alias'

    ]]);
Route::resource('/portfolios', 'PortfolioController', [
    'parameters' => [
        'portfolios' => 'alias'

]]);

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
