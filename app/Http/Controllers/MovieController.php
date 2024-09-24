<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        $movies = Movie::all();
        return view('movies.index', ['movies' => $movies]);
      }


    public function admin(){
      $movies = Movie::all();
        return view('admin.movies.index', ['movies' => $movies]);
    }

    public function create(){
      return view('admin.movies.create');
    }

    public function store(Request $request){
      $request->validate([
        'title' => 'required|string|unique:movies,title',
        'image_url' => 'required|url',
        'published_year' => 'required|integer',
        'is_showing' => 'boolean',
        'description' => 'required'
      ]);

      Movie::create([
        'title' => $request->title,
        'image_url' => $request->image_url,
        'published_year' => $request->published_year,
        'is_showing' => $request->has('is_showing') ? true : false,
        'description' => $request->description,
      ]);

      return redirect()->route('admin.movies.index')->with('success', '映画作品を登録しました。');
    }

    public function edit($id){
      $movie = Movie::findOrFail($id);
      return view('admin.movies.edit', ['movie' => $movie]);
    }

    public function update(Request $request, $id){
      $request->validate([
        'title' => 'required|string|unique:movies,title,'. $id,
        'image_url' => 'required|url',
        'published_year' =>'required|integer',
        'is_showing' =>'boolean',
        'description' =>'required'
      ]);

      $movie = Movie::findOrFail($id);
      $movie->update([
        'title' => $request->title,
        'image_url' => $request->image_url,
        'published_year' => $request->published_year,
        'is_showing' => $request->has('is_showing') ? true : false,
        'description' => $request->description,
      ]);

      return redirect()->route('admin.movies.index')->with('success', '映画作品を編集しました。');
    }

    public function destroy($id) {
      $movie = Movie::findOrFail($id);
      $movie->delete();

      return redirect()->route('admin.movies.index')->with('success', '映画を削除しました。');
    }
}
