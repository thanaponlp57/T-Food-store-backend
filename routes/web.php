<?php

use App\Http\Controllers\CustomerController;
use App\Modules\Authentication\Http\Controllers\AuthenticationController;
use App\Modules\Order\Http\Controllers\OrderController;
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
    // return view('welcome');
    return ['msg' => 'welcome'];
});


Route::post('/auth/login', [AuthenticationController::class, 'login']);


Route::group(['middleware' => ['auth.jwt.token']], function () {

    Route::post('/auth/logout', [AuthenticationController::class, 'logout']);

    Route::get('/orders', [OrderController::class, 'getAll']);
    Route::get('/orders/users/{id}', [OrderController::class, 'getAllByUserId']);
    Route::post('/orders/food', [OrderController::class, 'createOne']);
    Route::put('/orders/{id}', [OrderController::class, 'updateOne']);
    Route::delete('/orders/{id}', [OrderController::class, 'deleteOne']);
});
