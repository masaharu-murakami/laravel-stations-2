<?php
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;


Route::get('/movies',[MovieController::class,'index'])->name('movies.index');

Route::get('/admin/movies',[MovieController::class,'admin'])->name('admin.movies.index');

Route::get('/admin/movies/create',[MovieController::class,'create'])->name('admin.movies.create');
Route::post('/admin/movies/store',[MovieController::class,'store'])->name('admin.store');

Route::get('/admin/movies/{id}/edit',[MovieController::class, 'edit'])->name('admin.movies.edit');
Route::patch('/admin/movies/{id}/update',[MovieController::class, 'update'])->name('admin.movies.update');

Route::delete('/admin/movies/{id}/destroy',[MovieController::class, 'destroy'])->name('admin.movies.destroy');

Route::get('/sheets', [SheetController::class, 'index']);
