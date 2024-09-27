<?php

namespace App\Http\Controllers;

use App\Models\Sheet; // Sheetモデルをインポート
use Illuminate\Http\Request;

class SheetController extends Controller
{
    // GET /sheets のリクエストを処理するメソッド
    public function index()
    {
        // sheetsテーブルから全てのシートデータを取得
        $sheets = Sheet::all();

        // 取得したシートデータをビューに渡す
        return view('sheets.index', compact('sheets'));
    }
}