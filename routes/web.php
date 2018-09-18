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


Route::get('/', 'SiteController@index')->name('home');
Route::get('/article/{id}', 'SiteController@single')->name('single');
Route::get('/category', 'SiteController@category')->name('category_list');
Route::get('/category/{id}', 'SiteController@category_single')->name('category_single');
Route::get('/language/{lang}', 'SiteController@changeLang')->name('language')->where('lang', '(ru|en)');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

	Route::get('/home/{table?}', 'Admin\HomeController@index')->name('admin.home');
	Route::get('/home/language/{lang}', 'Admin\HomeController@changeLang')->name('admin.language')->where('lang', '(ru|en)');

	Route::group(['prefix' => 'table'], function(){

		Route::post('/articles/async', 'Admin\Operations\ArticleController@store_async_images')->name('admin.articles.async');


		Route::resource('/articles', 'Admin\Operations\ArticleController', ['names' => [
			'index' => 'admin.articles',
			'store' => 'admin.articles.store',
			'create' => 'admin.articles.create',
			//'destroy' => 'admin.articles.dest',
			'update' => 'admin.articles.update',
			'show' => 'admin.articles.show',
			'edit' => 'admin.articles.edit'
		]]);

		Route::get('/articles/destroy/{id}', 'Admin\Operations\ArticleController@destroy')->name('admin.articles.destroy');

		Route::resource('categories', 'Admin\Operations\CategoryController', ['names' => [
			'index' => 'admin.categories',
			'store' => 'admin.categories.store',
			'create' => 'admin.categories.create',
			'destroy' => 'admin.categories.destroy',
			'update' => 'admin.categories.update',
			'show' => 'admin.categories.show',
			'edit' => 'admin.categories.edit'
		]]);
	});
});


Auth::routes();
