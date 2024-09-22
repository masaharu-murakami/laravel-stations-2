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
        'is_showing' => $request->is_showing,
        'description' => $request->description,
      ]);

      return redirect()->route('admin.movies.index')->with('success', '映画作品を登録しました。');
    }
}
