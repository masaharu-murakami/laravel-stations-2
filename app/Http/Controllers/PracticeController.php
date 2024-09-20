<?php
namespace App\Http\Controllers;

use App\Practice;

class PracticeController extends Controller {
  public function sample() {
    return view('practice');
  }

  public function sample2(){
    $test = 'practice2';
    return view('practice2', ['testParam' => $test]);
  }

  public function sample3(){
    $sample = 'test';
    return view('practice3', ['testParam' => $sample]);
  }

  public function getPractice(){
    $practice = Practice::all();
    return view('getPractice', ['practice' => $practice]);
  }

}