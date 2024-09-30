<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約編集</title>
</head>
<body>
    <h1>予約編集</h1>

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form action="{{ isset($reservation) ? route('admin.reservations.update', $reservation->id) : route('admin.reservations.store') }}" method="POST">
        @csrf
        @if(isset($reservation))
            @method('PATCH') <!-- PATCH メソッドを指定 -->
        @endif

        <label for="movie_id">映画:</label>
        <select name="movie_id" required>
            <option value="">選択してください</option>
            @foreach ($movies as $movie)
                <option value="{{ $movie->id }}" {{ (old('movie_id', $reservation->movie_id ?? '') == $movie->id) ? 'selected' : '' }}>
                    {{ $movie->title }}
                </option>
            @endforeach
        </select><br>

        <label for="schedule_id">スケジュール:</label>
        <select name="schedule_id" required>
            <option value="">選択してください</option>
            @foreach ($schedules as $schedule)
                <option value="{{ $schedule->id }}" {{ (old('schedule_id', $reservation->schedule_id ?? '') == $schedule->id) ? 'selected' : '' }}>
                    {{ $schedule->start_time }}
                </option>
            @endforeach
        </select><br>

        <label for="sheet_id">座席:</label>
        <select name="sheet_id" required>
            <option value="">選択してください</option>
            @foreach ($sheets as $sheet)
                <option value="{{ $sheet->id }}" {{ (old('sheet_id', $reservation->sheet_id ?? '') == $sheet->id) ? 'selected' : '' }}>
                    {{ $sheet->id }}
                </option>
            @endforeach
        </select><br>
        <label for="date">日付:</label>
            <input type="date" name="date" value="{{ old('date', $reservation->date ?? '') }}" required>
        <br>

        <label for="name">名前:</label>
        <input type="text" name="name" value="{{ old('name', $reservation->name ?? '') }}" required><br>

        <label for="email">メールアドレス:</label>
        <input type="email" name="email" value="{{ old('email', $reservation->email ?? '') }}" required><br>

        <button type="submit">送信</button>
    </form>

    <a href="{{ route('admin.reservations.index') }}">戻る</a>
</body>
</html>
