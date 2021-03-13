<?php

use App\Ad;
use App\Http\Resources\Adresource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('categories', 'API\CategoryController@index');
Route::get('categories/{category}', 'API\CategoryController@subcategory');
Route::get('categories/{category}/questions', 'API\CategoryController@questions');
Route::get('categories/{category}/scores', 'API\CategoryController@scores');
Route::post('categories/{category}/scores/Save', 'API\CategoryController@saveScore');
Route::post('question/suggest', 'API\CategoryController@suggestionQuestion');

Route::get('ads', function () {
    return Adresource::collection(Ad::all());
});

