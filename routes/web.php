<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[DemoController::class,'demo1']);

Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

Route::get('/login1',[LoginController::class,'index']);
Route::get('/usercategory',[LoginController::class,'usercategory']);
Route::get('/userproduct/{categoryName}',[LoginController::class,'userproduct']);



//admin part
Route::get('/view_category',[AdminController::class,'view_category']);

Route::post('/add_category',[AdminController::class,'add_category']);

Route::get('/view_product',[AdminController::class,'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product');

Route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
Route::get('/show_product',[AdminController::class,'show_product']);
Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::get('/update_product/{id}',[AdminController::class,'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);


//cart controller
Route::post('/store_cart', [CartController::class, 'store']);
 Route::get('/get_cart_items', [CartController::class, 'getCartItems']);

 

//  Route::get('/profile', [ProfileController::class, 'show'])->name('profile_show'); 
//  Route::post('/profile', [ProfileController::class, 'update'])->name('profile_update');

//Route::get('/profile-api',[ProfileController::class,'show_api']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update');
    
});



Route::get('/payment',[PaymentController::class,'view']);

Route::get('/initiate-payment', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::post('/payment-complete', [PaymentController::class, 'completePayment'])->name('payment.complete');



require __DIR__.'/auth.php';