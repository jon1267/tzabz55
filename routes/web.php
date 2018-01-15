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

Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index')->name('index.simple');
Route::get('/datatable', 'IndexController@datatable')->name('index.datatable');
Route::get('/ajax', 'IndexController@ajax')->name('index.ajax');

//Route::get('/tree/{id}', 'TreeController@getTree')->name('index.tree');

//табличная часть
Route::get('/table/{id}', 'TreeController@getTable')->name('index.table');
Route::get('/table/depend/{id}', 'TreeController@showDepend')->name('table.child.parent');

// показыв ссылки дочек и ссылку их родителя...
Route::get('/child/{id}', 'TreeController@showChildAndReturn')->name('tree.child.parent');

//это пока полная версия дерева должностей (ссылки без ajax), запом. прошлых id в сессии
Route::get('/next/{id}/prev/{pid}', 'TreeController@showFullTree')->name('tree.full');
//вспом. к роуту выше. Чистит сессию и возвр. на верх дерева.
Route::get('/toptree', 'TreeController@showTopTree')->name('tree.top');

Route::get('/tree_class/{id}', 'TreeController@fullTreeClass')->name('tree.class');

//вывод таблицы сотрудников через ajax
Route::get('/tree_table/{id}', 'TreeController@showTable')->name('class.table');
