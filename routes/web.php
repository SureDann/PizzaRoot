<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $categories = \App\Models\PizzaCat::all();
    $data = ['category' => $categories];
    return view('welcome')->with($data);
})->name('home');

//Authentication
Route::prefix('/account')->group(function (){
    Route::get('/login', [AuthController::class, 'login_view'])->name('login_view');
    Route::get('/register', [AuthController::class, 'registration_view'])->name('registration_view');
    Route::post('/login_post', [AuthController::class, 'loginPost'])->name('login_post');
    Route::post('/register_post', [AuthController::class, 'registerPost'])->name('register_post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => '/food'], function (){
    Route::get('/prod/{pk}/', [PizzaController::class, 'pizza_view'])->name('pizza_view');
    Route::get('/prod_info/{pk}/', [PizzaController::class, 'prod_info_view'])->name('prod_info_view');
});

Route::group(['prefix'=>'/cart', 'middleware'=>'cart'], function (){
    Route::get('/user_cart', [CartController::class, 'cart_view'])->name('cart_view');
    Route::post('/add_cart', [CartController::class, 'add_cart'])->name('add_cart');
});
