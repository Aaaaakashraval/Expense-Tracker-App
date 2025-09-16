<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/',[UserController::class,'welcomeETA'])->name('welcomeETA');
Route::get('/signin',[UserController::class,'loginETA'])->name('loginETA');
Route::post('/signin',[UserController::class,'loginProcessETA'])->name('loginProcessETA');
Route::get('/singup',[UserController::class,'registerETA'])->name('registerETA');
Route::post('/singup',[UserController::class,'registerProcessETA'])->name('registerProcessETA');
Route::get('/dashboard',[UserController::class,'dashboardETA'])->name('dashboardETA');
Route::get('/monthly',[UserController::class,'monthETA'])->name('monthETA');
Route::get('/account',[UserController::class,'myaccountETA'])->name('myaccountETA');
Route::get('/accountupdate',[UserController::class,'updateaccountETA'])->name('updateaccountETA');
Route::post('/save-profile', [UserController::class, 'saveaccountETA'])->name('save.account');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/addexpense',[ExpenseController::class,'addexpenseETA'])->name('addexpenseETA');

Route::fallback(function(){return view('errorpage');
});
