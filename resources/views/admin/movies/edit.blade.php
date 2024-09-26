@extends('layouts.app')

@section('content')
<div class="container">
    <h1>映画の編集</h1>

    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PATCH')

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
        </div>

        <div class="form-group">
            <label for="image_url">画像URL</label>
            <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $movie->image_url) }}" required>
        </div>

        <div class="form-group">
            <label for="published_year">公開年</label>
            <input type="number" name="published_year" id="published_year" class="form-control" value="{{ old('published_year', $movie->published_year) }}" required>
        </div>

        <div class="form-group">
            <label for="is_showing">上映中</label>
            <input type="checkbox" name="is_showing" value="1" {{ old('is_showing') ? 'checked' : '' }}>
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $movie->description) }}</textarea>
        </div>

        <div>
            <label for="genre">ジャンル</label>
            <input type="text" name="genre" id="genre" value="{{ old('genre', $movie->genre->name ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('admin.movies.index') }}">一覧</a>
    </form>
</div>
@endsection
