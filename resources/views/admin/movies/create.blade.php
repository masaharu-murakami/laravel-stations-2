<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>映画の新規登録</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>映画の新規登録</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.movies.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">映画タイトル:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="image_url">画像URL:</label>
            <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" required>
        </div>

        <div>
            <label for="published_year">公開年:</label>
            <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}" required>
        </div>

        <div>
            <label for="is_showing">公開中:</label>
            <input type="checkbox" name="is_showing" id="is_showing" value="1" {{ old('is_showing') ? 'checked' : '' }}>
        </div>

        <div>
            <label for="description">概要:</label>
            <textarea name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="genre">ジャンル:</label>
             <input type="text" name="genre" id="genre" value="{{ old('genre', $movie->genre->name ?? '') }}" required>
        </div>

        <button type="submit">登録する</button>
        <a href="{{ route('admin.movies.index') }}">一覧に戻る</a>
    </form>
</body>
</html>
