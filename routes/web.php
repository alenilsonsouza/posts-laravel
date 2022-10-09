<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/postadd', [PostController::class, 'add'])->name('postadd');
Route::post('/postaddaction', [PostController::class, 'addAction']);

Route::get('/postedit/{id}', [PostController::class, 'edit'])->name('postedit');
Route::post('/posteditaction', [PostController::class, 'editAction']);

Route::get('/postdelete/{id}', [PostController::class, 'delete']);
