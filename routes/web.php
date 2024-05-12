<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;


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
    return view('welcome');
});
Route::get("/cart",[TransactionController::class,'fetchCart'])->name('cart');
Route::get("/order",[TransactionController::class,'order'])->name('order');
Route::get("/fecthProd",[TransactionController::class,'fecthProd'])->name('fecthProd');

Route::post("/placeOrder",[TransactionController::class,'placeOrder'])->name('placeOrder');

Route::match(['get','post'],"/remove/{id}",[TransactionController::class,'removeitem'])->name('removeitem');
Route::post("/clearCart",[TransactionController::class,'clearCart'])->name('clearCart');

// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get("/home",[HomeController::class,'index'])->middleware(['auth'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/add-to-cart', [TransactionController::class, 'addtocart'])->name('addtocart');
require __DIR__.'/auth.php';
//seller
Route::post('/addProd',[TransactionController::class, 'addProd'])->name('addProd');
Route::get('/gotoadd',[TransactionController::class, 'gotoadd'])->name('gotoadd');
Route::post('/update',[TransactionController::class, 'update'])->name('update');
Route::post('/updateStatus',[TransactionController::class, 'updateStatus'])->name('updateStatus');
Route::post('/acceptOrder',[TransactionController::class, 'acceptOrder'])->name('acceptOrder');

Route::get('/deleteProd/{id}',[TransactionController::class, 'deleteProd'])->name('deleteProd');
