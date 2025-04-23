<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/add_category',[AdminController::class,'add_category']);

Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product');

// Route::put('product/{id}/update',[ProductController::class,'update']);
Route::post('product/{id}/update',[ProductController::class,'update']);
Route::delete('product/{id}/delete',[ProductController::class,'destroy']);
Route::get('/login', [LoginController::class, 'index']);
//user part
Route::get('/usercategory',[LoginController::class,'usercategory']);
Route::get('/userproduct',[LoginController::class,'userproduct']);

Route::get('/show_product',[AdminController::class,'show_product']);

Route::post('/store_cart', [CartController::class, 'store']);
Route::get('/get_cart_items', [CartController::class, 'getCartItems']);

// Route::get('/profile', [ProfileController::class, 'show'])->name('profile_show'); 
// Route::post('/profile', [ProfileController::class, 'update'])->name('profile_update');


Route::post('/payment-complete', [PaymentController::class, 'completePayment'])->name('payment.complete');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update');
});