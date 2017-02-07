<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::post('carts/updateUsers/{carts}', 'CartsController@updateUsers');
Route::post('categories/addProducts/{categories}', 'CategoriesController@addProducts');
Route::post('manifacturers/addProducts/{manifacturers}', 'ManifacturersController@addProducts');
Route::post('products/updateManifacturers/{products}', 'ProductsController@updateManifacturers');
Route::post('products/addCategories/{products}', 'ProductsController@addCategories');
Route::post('users/addCarts/{users}', 'UsersController@addCarts');
Route::get('carts/related/{carts}', 'CartsController@related');
Route::get('carts/search', 'CartsController@search');
Route::get('carts/sort', 'CartsController@sort');
Route::resource('carts', 'CartsController');
Route::get('categories/related/{categories}', 'CategoriesController@related');
Route::get('categories/search', 'CategoriesController@search');
Route::get('categories/sort', 'CategoriesController@sort');
Route::resource('categories', 'CategoriesController');
Route::get('manifacturers/related/{manifacturers}', 'ManifacturersController@related');
Route::get('manifacturers/search', 'ManifacturersController@search');
Route::get('manifacturers/sort', 'ManifacturersController@sort');
Route::resource('manifacturers', 'ManifacturersController');
Route::get('products/related/{products}', 'ProductsController@related');
Route::get('products/search', 'ProductsController@search');
Route::get('products/sort', 'ProductsController@sort');
Route::resource('products', 'ProductsController');
Route::get('users/related/{users}', 'UsersController@related');
Route::get('users/search', 'UsersController@search');
Route::get('users/sort', 'UsersController@sort');
Route::resource('users', 'UsersController');
Route::post('carts/updateUser/{carts}', 'CartsController@updateUser');

Route::get('categories_products/related/{categories_products}', 'Categories_productsController@related');
Route::get('categories_products/search', 'Categories_productsController@search');
Route::get('categories_products/sort', 'Categories_productsController@sort');
Route::resource('categories_products', 'Categories_productsController');
