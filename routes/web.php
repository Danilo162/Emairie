<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:clear');
    // return what you want
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    // return what you want
});
Route::get('/storage-link', function() {
    $exitCode = Artisan::call('storage:link');
    // return what you want
});


Auth::routes();




Route::group([ 'namespace' => 'Frontend'],function () {

    Route::get('/', 'HomeController@index')->name('home');//pour pouvoir travailler

    //Added on 09042021
    Route::group([ 'prefix' => 'etatcivil'],function () {

        Route::get('/', 'EtatCivilController@index')->name('etatcivil');

        Route::get('/naissance', 'EtatCivilController@naissance')->name('etatcivil.naissance');

        Route::post('/naissance', 'EtatCivilController@SaveNaissance')->name('etatcivil.SaveNaissance');

        

    });
    
    

    Route::get('/mariage', function (){
        return view('component.mariage');
    })->name('home');

    Route::get('/actulite/{id}/detail', 'ActualiteController@detail')->name('actualite.detail');

    Route::group([ 'prefix' => 'actualite'],function () {
        Route::get('/detail', 'ActualiteController@detail')->name('actualite.detail');
    });
    Route::group([ 'prefix' => 'entreprise'],function () {
        Route::get('/detail', 'EntrepriseController@detail')->name('entreprise.detail');
    });

    Route::group([ 'prefix' => 'mairie'],function () {
        Route::get('/detail', 'MairieController@detail')->name('mairie.detail');
    });

    Route::group([ 'prefix' => 'commerce'],function () {
        Route::get('/lists', 'CommerceController@lists')->name('commerce.lists');
    });


    Route::group([ 'prefix' => 'demande', 'middleware' => 'auth'],function () {
        Route::get('/service', 'MairieController@service')->name('mairie.service');
        Route::post('/store', 'MairieController@demande_store')->name('demande.service.store');
    });

    Route::group([ 'prefix' => 'profile', 'middleware' => 'auth'],function () {
        Route::get('/', 'ProfileController@detail')->name('profile');
        Route::get('/demande', 'ProfileController@demande')->name('profile.demande');
        Route::get('/detail', 'ProfileController@detail')->name('profile.detail');
        Route::get('/print_extrait', 'ProfileController@print_file')->name('profile.extrait');
        Route::get('/commerce', 'ProfileController@commerce')->name('profile.commerce');
        Route::post('/store', 'ProfileController@demande_store')->name('profile.store');
    });

});




 Route::group(['prefix' => 'console', 'namespace' => 'Backend',  'middleware' => 'auth'],function (){
     Route::get('/', 'HomeController@index')->name('console.home');
     Route::post('/dashbord', 'HomeController@dashbord')->name('console.dashbord');
     Route::post('/dashbord/fonctionel', 'HomeController@dashbord_fonctionnel')->name('console.dashbord.fonctionel');
     Route::get('/theme', 'HomeController@theme')->name('console.theme');
     Route::post('/theme/store', 'HomeController@theme_store')->name('console.theme.store');

     Route::get('/up-cf', function(){return csrf_token();})->name('console.csrf');

     Route::get('check-session', 'HomeController@check_session')->name('console.check-session');

    // ROLES
     Route::group(['prefix' => 'role'],function (){
         Route::get('/', function (){ return view("role.index");})->name('console.role');
         Route::get('/index', 'RoleController@index')->name('console.role.index');
         Route::post('/store', 'RoleController@store')->name('console.role.store');
         Route::post('/destroy', 'RoleController@destroy')->name('console.role.destroy');

         Route::get('/{role}/permission', 'RoleController@permission')->name('console.role.permission');
         Route::get('/{role}/delegation', 'RoleController@delegation')->name('console.role.delegation');
         Route::post('delegation/store', 'RoleController@assignPermissionDelagation')->name('console.role.delegation_store');
         Route::post('delegation/destroy', 'RoleController@destroy_delegation')->name('console.role.delegation_destroy');
         Route::post('/assign-permission', 'RoleController@assignPermission')->name('console.role.assign-permission');

     });
     // PERMISSIONS
     Route::group(['prefix' => 'permission'],function (){
         Route::get('/', function (){ return view("permission.index");})->name('console.permission');
         Route::get('/index', 'PermissionController@index')->name('console.permission.index');
         Route::get('/index/delegue', 'PermissionController@index_delegue')->name('console.permission.index.delegue');
         Route::post('/store', 'PermissionController@store')->name('console.permission.store');
         Route::post('/destroy', 'PermissionController@destroy')->name('console.permission.destroy');
     });

     // COMMUNE
     Route::group(['prefix' => 'commune'],function (){
     Route::get('/', function (){ return view("commune.index");})->name('console.commune');
     Route::get('/index', 'CommuneController@index')->name('console.commune.index');
     Route::post('/store', 'CommuneController@store')->name('console.commune.store');
     Route::post('/destroy', 'CommuneController@destroy')->name('console.commune.destroy');
    });

     // COMMUNE
     Route::group(['prefix' => 'typetaxe'],function (){
     Route::get('/', function (){ return view("typetaxe.index");})->name('console.typetaxe');
     Route::get('/index', 'TypeTaxeController@index')->name('console.typetaxe.index');
     Route::post('/store', 'TypeTaxeController@store')->name('console.typetaxe.store');
     Route::post('/destroy', 'TypeTaxeController@destroy')->name('console.typetaxe.destroy');
         Route::get('{id}/detail', 'TypeTaxeController@detail')->name('console.typetaxe.detail');
    });

     // TYPE TAXE
     Route::group(['prefix' => 'typetaxeforfait'],function (){
     Route::get('/index', 'TypeTaxeForfaitController@index')->name('console.typetaxeforfait.index');
     Route::post('/store', 'TypeTaxeForfaitController@store')->name('console.typetaxeforfait.store');
     Route::post('/destroy', 'TypeTaxeForfaitController@destroy')->name('console.typetaxeforfait.destroy');
         Route::get('{id}/detail', 'TypeTaxeForfaitController@detail')->name('console.typetaxeforfait.detail');
    });

     // TYPE ACTUALITE
     Route::group(['prefix' => 'typeactualite'],function (){
     Route::get('/', function (){ return view("typeactualite.index");})->name('console.typeactualite');
     Route::get('/index', 'TypeActualiteController@index')->name('console.typeactualite.index');
     Route::post('/store', 'TypeActualiteController@store')->name('console.typeactualite.store');
     Route::post('/destroy', 'TypeActualiteController@destroy')->name('console.typeactualite.destroy');
    });

 // TYPE SERVICE
     Route::group(['prefix' => 'service'],function (){
     Route::get('/', function (){ return view("service.index");})->name('console.service');

     Route::get('/demande', function (){ return view("service.demande.index");})->name('console.demande');
     Route::get('/index/demande', 'ServiceController@index_demande')->name('console.service.index.demande');

    Route::get('/index', 'ServiceController@index')->name('console.service.index');
     Route::post('/store', 'ServiceController@store')->name('console.service.store');
     Route::post('/store/confirme', 'ServiceController@store_confirme')->name('console.service.store.confirme');
     Route::post('/destroy', 'ServiceController@destroy')->name('console.service.destroy');
    });


    // MAIRIE
    Route::group(['prefix' => 'mairie'],function (){
        Route::get('/', 'MairieController@lists')->name('console.mairie');
       /* Route::get('/', 'MairieController@ministere')->name('console.ministere');*/
        Route::get('/index', 'MairieController@index')->name('console.mairie.index');
        Route::post('/edit', 'MairieController@edit')->name('console.mairie.edit');
        Route::post('/store', 'MairieController@store')->name('console.mairie.store');
        Route::post('/store-etape', 'MairieController@store_etape')->name('console.store.service');
        Route::post('/destroy', 'MairieController@destroy')->name('console.mairie.destroy');
        Route::get('{id}/detail', 'MairieController@detail')->name('console.mairie.detail');
    });

    // AGENT
    Route::group(['prefix' => 'agent'],function (){
        Route::get('/', 'AgentController@lists')->name('console.agent');
        Route::get('/index', 'AgentController@index')->name('console.agent.index');
        Route::post('/infos', 'AgentController@getAgentById')->name('console.agent.infos');
        Route::post('/edit', 'AgentController@edit')->name('console.agent.edit');
        Route::get('{id}/detail', 'AgentController@detail')->name('console.agent.detail');
        Route::get('/profil', 'AgentController@profil')->name('console.agent.profil');
        Route::post('/store', 'AgentController@store')->name('console.agent.store');
        Route::post('/destroy', 'AgentController@destroy')->name('console.agent.destroy');
        Route::post('/changepass', 'AgentController@changePassword')->name('console.agent.changepass');
    });

    // COMMERCE
    Route::group(['prefix' => 'commerce'],function (){

        Route::post('/edit', 'CommerceController@edit')->name('console.commerce.edit');
        Route::get('{id}/detail', 'CommerceController@detail')->name('console.commerce.detail');
        Route::post('/store', 'CommerceController@store')->name('console.commerce.store');
        Route::post('/destroy', 'CommerceController@destroy')->name('console.commerce.destroy');

    });

    // ACTUALITE
    Route::group(['prefix' => 'actualite'],function (){
        Route::get('/', 'ActualiteController@lists')->name('console.actualite');
        Route::get('/index', 'ActualiteController@index')->name('console.actualite.index');
        Route::post('/infos', 'ActualiteController@getAgentById')->name('console.actualite.infos');
        Route::post('/edit', 'ActualiteController@edit')->name('console.actualite.edit');
        Route::get('{id}/detail', 'ActualiteController@detail')->name('console.actualite.detail');
        Route::get('/profil', 'ActualiteController@profil')->name('console.actualite.profil');
        Route::post('/store', 'ActualiteController@store')->name('console.actualite.store');
        Route::post('/destroy', 'ActualiteController@destroy')->name('console.actualite.destroy');

    });


    // ADMINISTRE
//    Route::view('administred', 'administred.index')->name('administred.index');

    // COMMERCES
    Route::view('commerce', 'commerce.index')->name('commerce.index');


     // ZONE
     Route::group(['prefix' => 'zone'],function (){
         Route::get('/', function (){ return view("zone.index");})->name('console.zone');
         Route::get('/index', 'ZoneController@index')->name('console.zone.index');
         Route::get('/agent', 'ZoneController@agent')->name('console.zone.agent');
         Route::post('/store', 'ZoneController@store')->name('console.zone.store');
         Route::post('/destroy', 'ZoneController@destroy')->name('console.zone.destroy');
         Route::get('{id}/detail', 'ZoneController@detail')->name('console.zone.detail');
         Route::get('/agent_not_attach', 'ZoneController@agentNoAttach')->name('console.agent.no.attach');

         Route::post('/attach_commerce_to_zone', 'ZoneController@attachToZone')->name('console.zone.attach');
         Route::post('/attach_agent_to_zone', 'ZoneController@attachAgentToZone')->name('console.zone.attach.agent');
         Route::post('/detach_to_zone', 'ZoneController@detattachToZone')->name('console.zone.detattach');
         Route::post('/detach_agent_to_zone', 'ZoneController@detattachAgentToZone')->name('console.zone.detattach.agent');


     });
     Route::group(['prefix' => 'commerce'],function (){
         Route::get('/', 'CommerceController@lists')->name('console.commerce');
         Route::get('/search', 'CommerceController@searchForUse')->name('console.commerce.search');
         Route::get('/index', 'CommerceController@index')->name('console.commerce.index');
         Route::get('/commerce_no_attach', 'CommerceController@commerceNoAttachToZone')->name('console.commerce.no_attach');
         Route::post('/edit', 'CommerceController@edit')->name('console.commerce.edit');
         Route::post('/choose_forfait', 'CommerceController@chooseForfait')->name('console.commerce.choose.forfait');
         Route::get('{id}/detail', 'CommerceController@detail')->name('console.commerce.detail');
         Route::get('/profil', 'CommerceController@profil')->name('console.commerce.profil');

     });
     Route::group(['prefix' => 'administred'],function (){
         Route::get('/', 'AdministredController@lists')->name('console.administred');
//         Route::get('/search', 'CommerceController@searchForUse')->name('console.administred.search');
         Route::get('/index', 'AdministredController@index')->name('console.administred.index');
         Route::get('/create', 'AdministredController@create')->name('console.administred.create');
//         Route::get('/commerce_no_attach', 'CommerceController@commerceNoAttachToZone')->name('console.commerce.no_attach');
         Route::post('/edit', 'AdministredController@edit')->name('console.administred.edit');
         Route::post('/store', 'AdministredController@store')->name('console.administred.store');
         Route::post('/destroy', 'AdministredController@destroy')->name('console.administred.destroy');
         Route::get('/detail', 'AdministredController@detail')->name('console.administred.detail');
         Route::get('/profil', 'AdministredController@profil')->name('console.administred.profil');

     });

     Route::group(['prefix' => 'taxecommerce'],function (){
         Route::get('/', 'TaxeCommercePaidedController@lists')->name('console.taxecommerce');
         Route::get('/index', 'TaxeCommercePaidedController@index')->name('console.taxecommerce.index');
         Route::post('/relance_to_sms', 'TaxeCommercePaidedController@relanceToSms')->name('console.taxecommerce.relance_to_sms');
         Route::post('/get_statistique', 'TaxeCommercePaidedController@getCommerceTAxeInfoForStatistique')->name('console.taxecommerce.statistique');

     });
     Route::group(['prefix' => 'month'],function (){
         Route::get('/', 'TaxeMonthController@lists')->name('console.month');
         Route::get('/index', 'TaxeMonthController@index')->name('console.month.index');
         Route::post('/store', 'TaxeMonthController@store')->name('console.month.store');
         Route::get('/commerce', 'TaxeCommercePaidedController@detail_commerce')->name('console.taxecommerce.detail');

     });

     Route::group(['prefix' => 'setting'],function (){
         Route::get('/', 'SettingController@lists')->name('console.setting');

         Route::post('/store', 'SettingController@store')->name('console.setting.store');

     });





 });
