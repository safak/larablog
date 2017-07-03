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

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

Route::get('/admin', function (){

    return view('admin.index');

})->name('admin.index');

Route::get('/admin/blog', 'Backend\BlogController@index')->name('admin.blog.index');
Route::get('/admin/blog/create', 'Backend\BlogController@create')->name('admin.blog.create');
Route::post('/admin/blog/create', 'Backend\BlogController@store')->name('admin.blog.store');
Route::get('/admin/blog/{id}/edit', 'Backend\BlogController@edit')->name('admin.blog.edit');
Route::post('/admin/blog/{id}/edit', 'Backend\BlogController@update')->name('admin.blog.update');
Route::get('/admin/blog/{id}/delete', 'Backend\BlogController@destroy')->name('admin.blog.delete');
Route::get('/admin/blog/{id}/forcedelete', 'Backend\BlogController@forcedestroy')->name('admin.blog.forcedelete');
Route::get('/admin/blog/{id}/restore', 'Backend\BlogController@restore')->name('admin.blog.restore');

Route::group(['prefix' => 'admin/category', 'middleware' => ['role:admin|editor']], function() {
    Route::get('/', 'Backend\CategoryController@index')->name('admin.category.index');
    Route::post('/', 'Backend\CategoryController@store')->name('admin.category.store');
    Route::post('/{id}/edit', 'Backend\CategoryController@update')->name('admin.category.update');
    Route::get('/{id}/edit', 'Backend\CategoryController@edit')->name('admin.category.edit');
    Route::get('/{id}/delete', 'Backend\CategoryController@destroy')->name('admin.category.delete');
});

Route::group(['prefix' => 'admin/tag', 'middleware' => ['role:admin|editor']], function() {
    Route::get('/', 'Backend\TagController@index')->name('admin.tag.index');
    Route::post('/', 'Backend\TagController@store')->name('admin.tag.store');
    Route::post('/{id}/edit', 'Backend\TagController@update')->name('admin.tag.update');
    Route::get('/{id}/edit', 'Backend\TagController@edit')->name('admin.tag.edit');
    Route::get('/{id}/delete', 'Backend\TagController@destroy')->name('admin.tag.delete');
});

Route::group(['prefix' => 'admin/user', 'middleware' => ['role:admin']], function() {
    Route::get('/', 'Backend\UserController@index')->name('admin.user.index');
    Route::get('/create', 'Backend\UserController@create')->name('admin.user.create');
    Route::post('/store', 'Backend\UserController@store')->name('admin.user.store');
    Route::get('/{id}/edit', 'Backend\UserController@edit')->name('admin.user.edit');
    Route::post('/{id}/update', 'Backend\UserController@update')->name('admin.user.update');
    Route::get('/{id}/delete', 'Backend\UserController@destroy')->name('admin.user.delete');
    Route::get('/{id}/deleteConfirm', 'Backend\UserController@deleteConfirm')->name('admin.user.deleteConfirm');
});

Route::get('admin/account', 'Backend\AccountController@index')->name('admin.account.index');
Route::get('admin/edit-account', 'Backend\AccountController@edit')->name('admin.account.edit');
Route::post('admin/edit-account', 'Backend\AccountController@update')->name('admin.account.update');


Route::get('/', 'BlogController@index')->name('blog.index');
Route::get('/{post}', 'BlogController@show')->name('blog.show');
Route::get('/category/{category}', 'BlogController@category')->name('blog.category.show');
Route::get('/author/{author}', 'BlogController@author')->name('blog.author.show');
Route::get('/tag/{tag}', 'BlogController@tag')->name('blog.tag.show');


