<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

// Routes for creating, storing, and updating posts
Route::get('/create', [PostController::class, 'create'])->name('create');
Route::post('/store', [PostController::class, 'fileStoring'])->name('store');
Route::get('/update/{id}', [PostController::class, 'updateData'])->name('update');
Route::put('/update/{id}', [PostController::class, 'update'])->name('update.post');
Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('delete.post');
