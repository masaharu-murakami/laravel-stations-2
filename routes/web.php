<?php
use App\Http\Controllers\MovieController;


Route::get('/movies',[MovieController::class,'index'])->name('index');

Route::get('/admin/movies',[MovieController::class,'admin'])->name('admin.movies.index');

Route::get('/admin/movies/create',[MovieController::class,'create'])->name('admin.create');
Route::post('/admin/movies/store',[MovieController::class,'store'])->name('admin.store');

Route::get('/admin/movies/{id}/edit',[MovieController::class, 'edit'])->name('admin.edit');
Route::patch('/admin/movies/{id}/update',[MovieController::class, 'update'])->name('admin.update');

Route::delete('/admin/movies/{id}/destroy',[MovieController::class, 'destroy'])->name('admin.movies.destroy');

