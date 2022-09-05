<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::resource('profil', UserController::class)->only([
    'index','store'
]);

Route::resource('dashboard', ProductController::class)->only([
    'index','show'
]);


$router->group(['prefix' => 'auth'], function () use ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// $router->group(['prefix' => 'admin'], function () use ($router) {
//     $router->get('/', function () {
//         return 'Admin';
//     });

//     $router->get('/show', function () {
//         return 'Admin';
//     });

//     $router->get('/show/{id}', [
//         'uses' => 'IndexController@show'
//     ]);
//     $router->post('/create', [
//         'uses' => 'IndexController@create'
//     ]);
// });
