<?php

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
    return view('welcome');
});

$prefixAdmin = config('zvn.url.prefix_admin');
$prefixNews  = config('zvn.url.prefix_news');



//!=================================================== ADMIN =======================================================
Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin'], function () {
    Route::get('user', function () {
        return '/admin/user';
    });

    //===== DASHBOARD ======
    $prefix         = 'dashboard';
    $controllerName = 'dashboard';

    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/',            ['as'   => $controllerName,             'uses' => $controller . 'index']);
    });

    //===== GROUP ======
    $prefix         = 'group';
    $controllerName = 'group';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';

        Route::get('/',            ['as'   => $controllerName,             'uses' => $controller . 'index']);
        Route::get('/form/{id?}',  ['as'   => $controllerName . '/form',   'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('/save',       ['as'   => $controllerName . '/save',  'uses' => $controller . 'save']);
        Route::get('/delete/{id}', ['as'   => $controllerName . '/delete',  'uses' => $controller . 'delete',])->where('id', '[0-9]+');
        Route::get('/change-status-{status}/{id}',  ['as'   => $controllerName . '/status',   'uses' => $controller . 'status',])->where('id', '[0-9]+');
        Route::get('/change-group_acp-{group_acp}/{id}',  ['as'   => $controllerName . '/group_acp',   'uses' => $controller . 'changeGroupACP',])->where('id', '[0-9]+');
    });
    //======== SLIDER =========
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
       
        Route::get('/',            ['as'   => $controllerName,             'uses' => $controller . 'index']);
        Route::get('/form/{id?}',  ['as'   => $controllerName . '/form',   'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('/save',       ['as'   => $controllerName . '/save',  'uses' => $controller . 'save']);
        Route::get('/delete/{id}', ['as'   => $controllerName . '/delete',  'uses' => $controller . 'delete',])->where('id', '[0-9]+');
        Route::get('/change-status-{status}/{id}',  ['as'   => $controllerName . '/status',   'uses' => $controller . 'status',])->where('id', '[0-9]+');

    });


});
