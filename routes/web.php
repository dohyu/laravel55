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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirect');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories', 'CategoriesController');

Route::get('/test', function() {
    //print_r(factory(App\Category::class)->make());
});

Route::get('articles/{category?}', 'ArticlesController@index');
Route::get('articles/{category?}/{id}', 'ArticlesController@show');
//Route::resource('articles/{category?}', 'ArticlesController');