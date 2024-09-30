<?php
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;

//admin
Route::get('/admin/movies',[MovieController::class,'admin'])->name('admin.movies.index');
// 映画作成
Route::get('/admin/movies/create',[MovieController::class,'create'])->name('admin.movies.create');
Route::post('/admin/movies/store',[MovieController::class,'store'])->name('admin.movies.store');
// 映画詳細
Route::get('/admin/movies/{id}',[MovieController::class,'show'])->name('admin.movies.show');
// 映画編集
Route::get('/admin/movies/{id}/edit',[MovieController::class, 'edit'])->name('admin.movies.edit');
Route::patch('/admin/movies/{id}/update',[MovieController::class, 'update'])->name('admin.movies.update');
// 映画削除
Route::delete('/admin/movies/{id}/destroy',[MovieController::class, 'destroy'])->name('admin.movies.destroy');

// 映画スケジュール作成
Route::get('/admin/movies/{movie}/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedules.create');
Route::post('/admin/movies/{movie}/schedules/store', [ScheduleController::class, 'store'])->name('admin.schedules.store');

//スケジュール一覧、編集、削除
Route::prefix('admin/schedules')->group(function () {
  Route::get('/', [ScheduleController::class, 'index'])->name('admin.schedules.index');
  Route::get('/{id}', [ScheduleController::class, 'show'])->name('admin.schedules.show');
});
Route::get('/admin/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('admin.schedules.edit');
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'update'])->name('admin.schedules.update');
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'destroy'])->name('admin.schedules.destroy');

// 管理者 予約機能
// Admin Routes
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
  Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
  Route::get('reservations/create', [AdminReservationController::class, 'create'])->name('reservations.create');
  Route::post('reservations', [AdminReservationController::class, 'store'])->name('reservations.store');
 // Route::get('reservations/{id}', [AdminReservationController::class, 'edit'])->name('reservations.edit');
  Route::patch('reservations/{id}', [AdminReservationController::class, 'update'])->name('reservations.update');
  Route::delete('reservations/{id}', [AdminReservationController::class, 'destroy'])->name('reservations.destroy');
});
Route::get('/admin/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');




//ユーザー
Route::get('/movies',[MovieController::class,'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'userShow'])->name('movies.show');

Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [SheetController::class, 'index'])->name('sheets.index');
Route::get('/sheets', [SheetController::class, 'sheet'])->name('sheets.sheet');

Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');





