<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

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

//Public methods
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

// Route::get('/products', [ProductController::class, 'GetProducts']);
Route::get('/products/{id}', [ProductController::class, 'GetProduct']);
// Route::post('/products', [ProductController::class, 'AddProduct']);
// Route::put('/products/{id}', [ProductController::class, 'UpdateProduct']);
// Route::delete('/products/{id}', [ProductController::class, 'DeleteProduct']);

// Route::get('order', [OrderController::class, 'GetOrders']);
// Route::get('order/{id}', [OrderController::class, 'GetOrder']);
// Route::post('order', [OrderController::class, 'AddOrder']);
// Route::put('order/updatestatus/{id}', [OrderController::class, 'UpdateStatus']);

//Protected methods
Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin routes
    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/products', [ProductController::class, 'AddProduct']);
        Route::put('/products/{id}', [ProductController::class, 'UpdateProduct']);
        Route::delete('/products/{id}', [ProductController::class, 'DeleteProduct']);
        
        Route::put('order/updatestatus/{id}', [OrderController::class, 'UpdateStatus']);
    });

    //user routes
    Route::group(['middleware' => ['role:user|admin']], function () {
        Route::get('/products', [ProductController::class, 'GetProducts']);

        Route::get('order', [OrderController::class, 'GetOrders']);
        Route::get('order/{id}', [OrderController::class, 'GetOrder']);
        Route::post('order', [OrderController::class, 'AddOrder']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});