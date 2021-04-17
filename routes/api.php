<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Mobile'],function () {
    Route::get('/check', 'MobileApiController@checker')->name('console.check');
    Route::post('/get_commune', 'MobileApiController@getCommune')->name('console.get.commune');
    Route::post('/get_type_commerce', 'MobileApiController@getTypeCommerce')->name('console.get.type.commerce');
    Route::post('/login', 'MobileApiController@login')->name('console.login');
    Route::post('/store_step_one', 'MobileApiController@storeStepOne')->name('console.store.one');
    Route::post('/store_step_two', 'MobileApiController@storeStepTwo')->name('console.store.two');
    Route::post('/store_step_three', 'MobileApiController@storeStepThree')->name('console.store.three');
    Route::get('/virtual_account', 'MobileApiController@virtualAccount')->name('console.virtual_account');
    Route::get('/administred_info', 'MobileApiController@getAdministredInfo')->name('console.administred_info');
    Route::get('/get_administred', 'MobileApiController@getAdministreds')->name('console.administred');
    Route::get('/get_commerce', 'MobileApiController@getCommerces')->name('console.commerce');
    Route::get('/get_taxe', 'MobileApiController@getTaxes')->name('console.taxe');
    Route::get('/get_news', 'MobileApiController@getNews')->name('console.news');
    Route::post('/get_barner', 'MobileApiController@getBarner')->name('console.barner');
    Route::get('/get_service', 'MobileApiController@getService')->name('console.mobile.service');
    Route::post('/get_mairie', 'MobileApiController@getMairie')->name('console.mobile.mairie');
    Route::post('/store_taxe_paided', 'MobileApiController@storeTaxePaided')->name('console.taxe.paided');
    Route::post('/store_demande_service', 'MobileApiController@storeDemandeService')->name('console.store.demande.service');


    Route::post('/store_commerce_step_one', 'MobileApiController@storeCommerceStepOne')->name('console.store.commerce.one');
});
