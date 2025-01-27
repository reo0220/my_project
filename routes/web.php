<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/top', [App\Http\Controllers\TopController::class, 'index']);
Route::get('/sample', [App\Http\Controllers\SampleController::class, 'index']);

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index']);
Route::post('/register', [App\Http\Controllers\LoginController::class, 'register']);
Route::get('/unregister', [App\Http\Controllers\LoginController::class, 'unregister']);
