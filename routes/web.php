<?php

use App\Http\Controllers\TodoController;

// Routes for displaying all todos and creating a new todo
Route::get('/', [TodoController::class, 'index'])->name('index');
Route::get('/create', [TodoController::class, 'create'])->name('create');

// Routes for storing a new todo and displaying a specific todo
Route::post('/', [TodoController::class, 'store'])->name('store');

// Routes for displaying the form to edit a todo and updating a todo
Route::get('/{todo}/edit', [TodoController::class, 'edit'])->name('edit');
Route::put('/{todo}', [TodoController::class, 'update'])->name('update');

// Route for deleting a todo
Route::get('/{todo}/delete', [TodoController::class, 'delete'])->name('delete');
Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('destroy');
