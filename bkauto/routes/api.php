<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Models\Type;
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

// ----------------USER-----------------
Route::prefix('user')->group( function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('me', [UserController::class, 'me']);
    Route::post('update', [UserController::class, 'update']);

    // cart crud
    Route::prefix('carts')->group(function() {
        Route::get('index', [CartController::class, 'index']);
        Route::post('create/{id}', [CartController::class, 'store']);
        Route::post('update/{id}', [CartController::class, 'update']);
        Route::delete('delete/{id}', [CartController::class, 'destroy']);
        Route::get('history', [CartController::class, 'history']);
    });

    // add bill - show bill
    Route::prefix('bills')->group(function() {
        Route::post('create', [BillController::class, 'store']);
        Route::post('update', [BillController::class, 'update']);
        Route::get('show-bills', [BillController::class, 'show']);
    });
});
//end user


// -------------ADMIN---------------
Route::prefix('admin')->group( function () {
    Route::post('login', [AdminController::class, 'login']);
    Route::post('register', [AdminController::class, 'register']);
    Route::post('logout', [AdminController::class, 'logout']);
    Route::get('me', [AdminController::class, 'me']);
    Route::post('update', [AdminController::class, 'update']);

    // product curd
    Route::prefix('products') ->group(function() {
        Route::get('index', [ProductController::class, 'index']);
        Route::post('create', [ProductController::class, 'store']);
        Route::post('update/{id}', [ProductController::class, 'update']);
        // Route::delete('delete/{id}', [ProductController::class, 'destroy']);
        Route::get('export-excel', [ProductController::class, 'exportIntoExcel']);
    });

    // type curd
    Route::prefix('types')->group(function() {
        Route::get('index', [TypeController::class, 'index']);
        Route::post('create', [TypeController::class, 'store']);
        Route::post('update/{id}', [TypeController::class, 'update']);
        // Route::delete('delete/{id}', [TypeController::class, 'destroy']);
    });

    // delete bill - show all bills
    Route::prefix('bills')->group(function() {
        Route::get('index', [BillController::class, 'index']);
        Route::delete('delete-bill/{id}', [BillController::class, 'destroy']);
        Route::get('turnover', [BillController::class, 'history']);
        Route::post('confirm/{id}', [BillController::class, 'confirm']);
    });

    //cartForBill
    Route::get('carts', [CartController::class, 'cartForBill']);
});
// end admin
// import export file tu ngoai vao web de cap nhat
Route::prefix('products')->group(function() {
    Route::get('show/{id}', [ProductController::class, 'show']);
    Route::post('searchId/{id}', [ProductController::class, 'sortById']);
    Route::post('search-name/{name}', [ProductController::class, 'searchByName']);
});

Route::prefix('types')->group(function() {
    Route::get('index',[TypeController::class, 'index']);
});
