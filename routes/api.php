<?php

use Illuminate\Http\Request;

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

/* auth */
Route:: group ([ 'middleware' => [ 'api' , 'cors' ]], function () {
    Route:: post ( 'auth/login' , 'Auth\ApiAuthController@login' );
});


Route:: group ([ 'middleware' => [ 'api' , 'cors' , 'jwt.auth'] ], function (){
    Route::get('shoppingLists', 'ShoppingListController@index');

    Route::put('shoppingList/{id}', 'ShoppingListController@update');

    Route::post('shoppingList', 'ShoppingListController@save');

    Route::get('shoppingList/{id}', 'ShoppingListController@getSingleList');

    Route::get('shoppingLists/open/{userId}', 'ShoppingListController@getOpenLists');

    Route::get('shoppingLists/done/{userId}', 'ShoppingListController@getDoneLists');

    Route::post ( 'shoppingList/feedback' , 'ShoppingListController@saveFeedback' );

    Route::post ( 'auth/logout' , 'Auth\ApiAuthController@logout' );
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
