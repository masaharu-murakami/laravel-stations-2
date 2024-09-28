@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $movie->title }} のスケジュール追加</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <form action="{{ route('admin.schedules.store', $movie->id) }}" method="POST">

        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
        <!-- ここに開始時間と終了時間の入力フィールドを追加 -->
        <div class="form-group">
            <label for="start_time_date">開始日</label>
            <input type="date" name="start_time_date" id="start_time_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_time_time">開始時間</label>
            <input type="time" name="start_time_time" id="start_time_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time_date">終了日</label>
            <input type="date" name="end_time_date" id="end_time_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time_time">終了時間</label>
            <input type="time" name="end_time_time" id="end_time_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">スケジュールを作成</button>
    </form>
    <a href="{{ route('admin.movies.index') }}">一覧に戻る</a>
</div>
@endsection
