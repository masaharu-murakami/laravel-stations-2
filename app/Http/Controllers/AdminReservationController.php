<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminReservationRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Sheet;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index()
{
    // 現在の日時よりも上映が終了していない予約のみを取得
    $reservations = Reservation::with('sheet')
        ->whereHas('schedule', function ($query) {
            $query->where('end_time', '>', now());
        })
        ->get(); // 終了していない予約を取得

    return view('admin.reservations.index', [
        'reservations' => $reservations
    ]);
}

    public function create()
    {
        $schedules = Schedule::all();
        $sheets = Sheet::all();
        $movies = Movie::all();

        return view('admin.reservations.create', compact('schedules', 'sheets', 'movies'));
    }

    public function store(CreateAdminReservationRequest $request)
    {
        // スケジュールIDが存在するか確認
        $schedule = Schedule::find($request->schedule_id);
        if (!$schedule) {
            return redirect()->back()->withErrors(['schedule_id' => 'スケジュールが無効です']);
        }

        // 予約の作成
        Reservation::create([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'name' => $request->name,
            'email' => $request->email,
            'date' => Carbon::now()->format('Y-m-d'), // 現在の日付を使用
        ]);

        return redirect()->route('admin.reservations.index')->with('success', '予約が作成されました');
    }

    public function edit($id)
{
    $reservation = Reservation::with('sheet')->findOrFail($id);

    // 映画とスケジュールを取得
    $movies = Movie::all(); // ここで全映画を取得
    $schedules = Schedule::all(); // ここで全スケジュールを取得
    $sheets = Sheet::all();

    return view('admin.reservations.edit', compact('reservation', 'movies', 'schedules', 'sheets'));
}

public function update(CreateAdminReservationRequest $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    // リクエストから取得した値を更新
    //$reservation->movie_id = $request->movie_id;
    $reservation->schedule_id = $request->schedule_id;
    $reservation->sheet_id = $request->sheet_id;
    $reservation->name = $request->name;
    $reservation->email = $request->email;

    // ここで日付を設定（必要に応じてリクエストから取得）
    $reservation->date = now(); // もしくは適切な日付を設定

    $reservation->save();

    return redirect()->route('admin.reservations.index')->with('success', '予約が更新されました。');
}


    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->route('admin.reservations.index')->with('success', '予約が削除されました');
    }
}
