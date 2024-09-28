@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $schedule->movie->title }} のスケジュール編集</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.schedules.update', ['id' => $schedule->id]) }}">
        @csrf
        @method('PATCH') <!-- PATCH メソッドを使用 -->
        
        <div class="form-group">
            <label for="start_time_date">開始日付:</label>
            <input type="date" name="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="start_time_time">開始時間:</label>
            <input type="time" name="start_time_time" value="{{ $schedule->start_time->format('H:i') }}" required>
        </div>

        <div class="form-group">
            <label for="end_time_date">終了日付:</label>
            <input type="date" name="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="end_time_time">終了時間:</label>
            <input type="time" name="end_time_time" value="{{ $schedule->end_time->format('H:i') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('admin.schedules.index') }}">一覧に戻る</a>
    </form>
</div>
@endsection
