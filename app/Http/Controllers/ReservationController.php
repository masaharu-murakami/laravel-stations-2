<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Carbon\CarbonImmutable; // Carbonをインポート

class ReservationController extends Controller
{
    // 予約フォームを表示するメソッド
    public function create(Request $request, $movie_id, $schedule_id)
    {
        if (empty($request->date) || empty($request->query('sheet_id'))) {
            return App::abort(400);
        }

        $sheet_id = $request->query('sheet_id');
        $date = $request->query('date');

        return view('reservations.create', compact('movie_id', 'schedule_id', 'sheet_id', 'date'));
    }

    // 予約を保存するメソッド
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required|exists:schedules,id',
            'sheet_id' => 'required|exists:sheets,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255', // 最大255文字に制限
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 予約が既に存在するか確認
        $existingReservation = Reservation::where('schedule_id', $request->schedule_id)
            ->where('sheet_id', $request->sheet_id)
            ->where('date', CarbonImmutable::parse($request->date)->format('Y-m-d')) // 日付を正しい形式で確認
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withErrors(['sheet_id' => 'その座席はすでに予約済みです'])->withInput();
        }

        // 予約を作成
        Reservation::create([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'name' => $request->name,
            'email' => $request->email,
            'date' => CarbonImmutable::parse($request->date)->format('Y-m-d'), // 日付を正しい形式で保存
        ]);

        return redirect()->route('movies.index')->with('success', '予約が完了しました');
    }
}
