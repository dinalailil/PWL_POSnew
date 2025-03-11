<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/kategori', [CategoriesController::class, 'index']);
Route::get('/levels', [LevelController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
