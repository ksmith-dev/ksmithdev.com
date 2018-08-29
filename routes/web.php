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

Route::get('/', 'LandingController@index');
Route::get('/skill', 'SkillController@skills');
Route::get('/skill/inactive', 'SkillController@inactive');
Route::get('/experience', 'ExperienceController@experiences');
Route::get('/experience/inactive', 'ExperienceController@inactive');
Route::get('/contact', 'ContactController@form');

Route::post('/search', 'SearchController@search');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/form/{table}', 'FormController@form');
Route::get('/form/{table}/{id}', 'FormController@form');

Route::get('/remove/{table}/{id}', 'FormController@destroy');

Route::post('/contact', 'ContactController@contact');

Route::post('/form/{table}', 'FormController@store');
Route::post('/form/{table}/{id}', 'FormController@store');
