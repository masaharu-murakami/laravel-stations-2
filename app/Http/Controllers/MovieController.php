<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class MovieController extends Controller
{
    public function index(Request $request) {
        $query = Movie::query();

        if ($request->has('is_showing')) {
            $query->where('is_showing', $request->is_showing === '1');
        }

        if ($request->has('keyword') && $request->keyword !== '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $movies = $query->paginate(20);
        return view('movies.index', compact('movies'));
    }

    public function admin(){
        $movies = Movie::all();
        return view('admin.movies.index', ['movies' => $movies]);
    }

    public function create(){
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    public function show($id) {
        $movie = Movie::find($id); // 指定されたIDの映画を取得
        if (!$movie) {
            abort(404); // 映画が見つからなければ404エラーを返す
        }

        $schedules = Schedule::where('movie_id', $id)->orderBy('start_time', 'asc')->get();
        return view('admin.movies.show', compact('movie', 'schedules')); // show ビューを返す
    }

    public function store(Request $request) {
        //dd($request->all());
        $request->validate([
            'title' => 'required|string|unique:movies,title',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'boolean',
            'description' => 'required',
            'genre' => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $genre = Genre::firstOrCreate(['name' => $request->genre]);
                //dd($genre);

                $movie = Movie::create([
                    'title' => $request->title,
                    'image_url' => $request->image_url,
                    'published_year' => $request->published_year,
                    'is_showing' => $request->has('is_showing'),
                    'description' => $request->description,
                    'genre_id' => $genre->id,
                ]);
                //$movie->load('genre');
                //dd($movie);
            });

            return redirect()->route('admin.movies.index')->with('success', '映画作品を登録しました。');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            //return response()->json(['error' => $e->getMessage()], 500);
            return response()->json(['error' => '映画の登録に失敗しました。'], 500);
        }
    }

    public function edit($id){
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', ['movie' => $movie]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|unique:movies,title,' . $id,
            'image_url' => 'required|url',
            'published_year' =>'required|integer',
            'is_showing' =>'boolean',
            'description' =>'required',
            'genre' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $genre = Genre::firstOrCreate(['name' => $request->genre]);

            $movie = Movie::findOrFail($id);
            $movie->update([
                'title' => $request->title,
                'image_url' => $request->image_url,
                'published_year' => $request->published_year,
                'is_showing' => $request->has('is_showing'),
                'description' => $request->description,
                'genre_id' => $genre->id,
            ]);
        });

        return redirect()->route('admin.movies.index')->with('success', '映画作品を編集しました。');
    }

    public function destroy($id) {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', '映画を削除しました。');
    }

   // 一般ユーザー用の映画詳細画面
   public function userShow($id) {
    $movie = Movie::find($id);
    if (!$movie) {
        abort(404);
    }

    $schedules = Schedule::where('movie_id', $id)->orderBy('start_time', 'asc')->get();
    return view('movies.show', compact('movie', 'schedules'));
}
}
