<?php

// app/Http/Controllers/ScheduleController.php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateScheduleRequest;
class ScheduleController extends Controller


{
    public function index()
    {
        $movies = Movie::with('schedules')->has('schedules')->get();
        return view('admin.schedules.index', compact('movies'));
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.show', compact('schedule'));
    }

    public function create($id)
    {
        //Log::info("Creating schedule for movie ID: $movieId");
        $movie = Movie::findOrFail($id);
        return view('admin.schedules.create', compact('movie'));
    }

    public function store(CreateScheduleRequest $request)
    {
        // 開始時刻と終了時刻を Carbon インスタンスに変換
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_time_date . ' ' . $request->start_time_time);
        $endTime = Carbon::createFromFormat('Y-m-d H:i', $request->end_time_date . ' ' . $request->end_time_time);
    
        // 映画を取得
        $movie = Movie::findOrFail($request->movie_id);
    
        // スケジュールを作成
        Schedule::create([
            'movie_id' => $request->movie_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    
        return redirect()->route('admin.schedules.index')->with('success', 'スケジュールを作成しました');
    }
    




    public function edit($id)
    {
        // スケジュールとその関連映画を取得
        $schedule = Schedule::with('movie')->findOrFail($id);
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
{
    // バリデーション
    $request->validate([
        'movie_id' => 'required|exists:movies,id',
        'start_time_date' => 'required|date_format:Y-m-d',
        'start_time_time' => 'required|date_format:H:i',
        'end_time_date' => 'required|date_format:Y-m-d',
        'end_time_time' => 'required|date_format:H:i',
    ]);

    // スケジュールを取得
    $schedule = Schedule::findOrFail($id);

    // 開始時間と終了時間を組み合わせて設定
    $schedule->movie_id = $request->movie_id;
    $schedule->start_time = Carbon::createFromFormat('Y-m-d H:i', $request->start_time_date . ' ' . $request->start_time_time);
    $schedule->end_time = Carbon::createFromFormat('Y-m-d H:i', $request->end_time_date . ' ' . $request->end_time_time);

    // 更新を保存
    $schedule->save();

    // 成功メッセージと共にリダイレクト
    return redirect()->route('admin.schedules.index')->with('success', 'スケジュールを更新しました');
}

public function destroy($id)
{
    // スケジュールを取得し、存在しない場合は404エラーを返す
    $schedule = Schedule::findOrFail($id);

    // スケジュールを削除
    $schedule->delete();

    // 成功メッセージと共にリダイレクト
    return redirect()->route('admin.schedules.index')->with('success', 'スケジュールを削除しました');
}
}
