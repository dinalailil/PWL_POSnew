<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/kategori', [CategoriesController::class, 'index']);
Route::get('/levels', [LevelController::class, 'index']);

