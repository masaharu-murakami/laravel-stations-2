@extends('layouts.app')

@section('content')
<div class="container">
    <h1>映画一覧</h1>

    <form method="GET" action="{{ route('movies.index') }}">
        <div class="form-group">
            <label for="keyword">キーワード検索:</label>
            <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" class="form-control">
        </div>

        <div class="form-group">
            <label>表示:</label><br>
            <input type="radio" name="is_showing" value="1" {{ request('is_showing') === '1' ? 'checked' : '' }}> 公開中
            <input type="radio" name="is_showing" value="0" {{ request('is_showing') === '0' ? 'checked' : '' }}> 公開予定
            <input type="radio" name="is_showing" value="" {{ request('is_showing') === null ? 'checked' : '' }}> 全て
        </div>

        <button type="submit" class="btn btn-primary">検索</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>画像URL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="100"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $movies->links() }} <!-- ページネーション -->
</div>
@endsection
