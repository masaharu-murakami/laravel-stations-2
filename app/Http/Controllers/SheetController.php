<?php

namespace App\Http\Controllers;

use App\Models\Sheet; // Sheetモデルをインポート
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SheetController extends Controller
{
    public function index(Request $request, $movie_id, $schedule_id)
        {
            if(empty($request->date)) {
                return App::abort(400);
            }

            $movie_id = Movie::find($movie_id);
            $schedule = Schedule::find($schedule_id);

            $sheets = Sheet::all();

            $date = $request->query('date');

            // 取得したシートデータをビューに渡す
            return view('sheets.index', compact('sheets', 'movie_id', 'schedule_id', 'date'));
        }

        public function sheet()
        {
            $sheets = Sheet::all();
            $sheetList = [];
            foreach($sheets as $sheet) {
                $sheetList[$sheet['row']][] = [
                    'id' => $sheet['id'],
                    'name' => $sheet['row'] . '-' . $sheet['column']
                ];
            }
            return view('sheets.sheets', [
                'sheetList' => $sheetList
            ]);
        }

}
