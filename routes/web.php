<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/session',[TestController::class,'index'])->name('session');
Route::get('/storesession',[TestController::class,'storeSession']);
Route::get('/deletesession',[TestController::class,'deleteSession']);
Route::resource('books',BookController::class);

// Route::get('user',[UserController::class,'index'])->name('index')->middleware(ValidUser::class);
Route::get('user',[UserController::class,'index'])->name('index');
Route::get('login',[UserController::class,'login'])->name('login');
Route::post('/store',[UserController::class,'store'])->name('store');
Route::post('/loginCheck',[UserController::class,'loginCheck'])->name('loginCheck');
Route::get('/update/{id}',[UserController::class,'update'])->name('update');

Route::get('/dashboard',[UserController::class,'dashboardPage'])->name('dashboard')->middleware('can:isAdmin');
Route::get('/logout',[UserController::class,'logout'])->name('logout')->middleware(['IsValidUser:admin']);
// Route::middleware(['auth','IsValidUser:admin'])->group(function(){
//     Route::get('/dashboard',[UserController::class,'dashboardPage'])->name('dashboard');
//     Route::get('/logout',[UserController::class,'logout'])->name('logout');
// });

// Route::get('/dashboard',[UserController::class,'dashboardPage'])->name('dashboard')->middleware(['IsValidUser']);
// Route::get('/logout',[UserController::class,'logout'])->name('logout')->middleware(['IsValidUser']);
