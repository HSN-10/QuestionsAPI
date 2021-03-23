<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => 'adminpanel', 'middleware' => ['auth']], function () {

    // Admin Only
    Route::group(['middleware'=>['admin']], function(){

        // Categories URL
        Route::get('category/trash', 'dashboard\CategoryController@trash')->name('category.trash');
        Route::get('category/{id}/undo', 'dashboard\CategoryController@undo')->name('category.undo');
        Route::delete('category/{category}/forceDelete', 'dashboard\CategoryController@forceDelete')->name('category.forceDelete');

        // Questions URL
        Route::get('question/trash', 'dashboard\QuestionController@trash')->name('question.trash');
        Route::get('question/{id}/undo', 'dashboard\QuestionController@undo')->name('question.undo');
        Route::delete('question/{id}/forceDelete', 'dashboard\QuestionController@forceDelete')->name('question.forceDelete');

        // Users URl
        Route::get('user/trash', 'dashboard\UserController@trash')->name('user.trash');
        Route::get('user/{id}/undo', 'dashboard\UserController@undo')->name('user.undo');
        Route::delete('user/{id}/forceDelete', 'dashboard\UserController@forceDelete')->name('user.forceDelete');
        Route::put('user/{user}/changepassword', 'dashboard\UserController@changepassword_admin')->name('user.changepassword_admin');

        // Ads URL
        Route::get('ad/trash', 'dashboard\AdController@trash')->name('ad.trash');
        Route::get('ad/{id}/undo', 'dashboard\AdController@undo')->name('ad.undo');
        Route::delete('ad/{id}/forceDelete', 'dashboard\AdController@forceDelete')->name('ad.forceDelete');

        // Scores URL
        Route::get('category/{category}/score/trash', 'dashboard\ScoreController@trash')->name('score.trash');
        Route::get('category/{category}/score/{id}/undo', 'dashboard\ScoreController@undo')->name('score.undo');
        Route::delete('category/{category}/score/{id}/forceDelete', 'dashboard\ScoreController@forceDelete')->name('score.forceDelete');
    });

    // Home Page
    Route::get('/', 'dashboard\HomeController@index')->name('adminpanel');

    // Categories URL
    Route::resource('category', 'dashboard\CategoryController');

    // Questions URL
    Route::get('question/create/{category}', 'dashboard\QuestionController@createWithCategory')->name('question.createWithCategory');
    Route::get('question/{question}/active', 'dashboard\QuestionController@active')->name('question.active');
    Route::get('question/inactive', 'dashboard\QuestionController@inactive')->name('question.inactive');
    Route::resource('question', 'dashboard\QuestionController');

    // Users URl
    Route::get('user/profile/edit', 'dashboard\UserController@profileEdit')->name('user.profileEdit');
    Route::put('user/profile/update', 'dashboard\UserController@profileUpdate')->name('user.profileUpdate');
    Route::put('user/profile/changepassword', 'dashboard\UserController@changepassword')->name('user.changepassword');
    Route::resource('user', 'dashboard\UserController');

    // Ads URL
    Route::get('ad/{ad}/active', 'dashboard\AdController@active')->name('ad.active');
    Route::resource('ad', 'dashboard\AdController');

    // Scores URL
    Route::resource('category/{category}/score', 'dashboard\ScoreController');
});

// Loing URL
Route::group(['prefix' => 'adminpanel'], function () {
    Auth::routes();
});
