@extends('layouts.app')

@section('content')
<div class="container">
    <h1>上映スケジュール一覧</h1>

    @foreach ($movies as $movie)
        <h2>{{ $movie->id }}: {{ $movie->title }}</h2>
        <ul>
            @foreach ($movie->schedules as $schedule)
                <li>
                    開始時刻: {{ $schedule->start_time->format('Y-m-d H:i') }},
                    終了時刻: {{ $schedule->end_time->format('Y-m-d H:i') }}
                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}">編集</a>
                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('admin.movies.show', $movie->id) }}">映画詳細へ</a>
        <a href="{{ route('admin.schedules.create', $movie->id) }}">スケジュール追加</a>
        <a href="{{ route('admin.movies.index') }}">一覧に戻る</a>
    @endforeach
</div>
@endsection
