<?php
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;


Route::get('/movies',[MovieController::class,'index'])->name('movies.index');

Route::get('/admin/movies',[MovieController::class,'admin'])->name('admin.movies.index');

Route::get('/admin/movies/create',[MovieController::class,'create'])->name('admin.movies.create');
Route::post('/admin/movies/store',[MovieController::class,'store'])->name('admin.movies.store');

Route::get('/admin/movies/{id}',[MovieController::class,'show'])->name('admin.movies.show');

Route::get('/admin/movies/{id}/edit',[MovieController::class, 'edit'])->name('admin.movies.edit');
Route::patch('/admin/movies/{id}/update',[MovieController::class, 'update'])->name('admin.movies.update');

Route::delete('/admin/movies/{id}/destroy',[MovieController::class, 'destroy'])->name('admin.movies.destroy');

Route::get('/sheets', [SheetController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');


Route::get('/admin/movies/{movie}/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedules.create');
Route::post('/admin/movies/{movie}/schedules/store', [ScheduleController::class, 'store'])->name('admin.schedules.store');


Route::get('/admin/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('admin.schedules.edit');
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'update'])->name('admin.schedules.update');

Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'destroy'])->name('admin.schedules.destroy');


Route::prefix('admin/schedules')->group(function () {
  Route::get('/', [ScheduleController::class, 'index'])->name('admin.schedules.index');
  Route::get('/{id}', [ScheduleController::class, 'show'])->name('admin.schedules.show');
});