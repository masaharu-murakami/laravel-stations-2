@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約フォーム</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie_id }}">
        <input type="hidden" name="schedule_id" value="{{ $schedule_id }}">
        <input type="hidden" name="sheet_id" value="{{ $sheet_id }}"> <!-- ここを修正 -->
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="form-group">
            <label for="name">予約者氏名</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">予約者メールアドレス</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">予約する</button>
    </form>
</div>
@endsection
