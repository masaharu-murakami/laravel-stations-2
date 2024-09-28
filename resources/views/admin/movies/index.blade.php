<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>映画一覧</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">映画一覧</h1>

    @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif

    <table class="table table-striped mt-3">
      <thead>
        <tr>
          <th>映画のタイトル</th>
          <th>映画URL</th>
          <th>公開年</th>
          <th>上映状況</th>
          <th>概要</th>
          <th>ジャンル</th>
          <th>操作</th>
          <th>詳細</th> <!-- 新しい列を追加 -->
        </tr>
      </thead>
      <tbody>
        @foreach ($movies as $movie)
        <tr>
          <td>{{ $movie->title }}</td>
          <td><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="100"></td>
          <td>{{ $movie->published_year }}</td>
          <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
          <td>{{ $movie->description }}</td>
          <td>
            @if ($movie->genre)
              {{ $movie->genre->name }}
            @else
              未設定
            @endif
          </td>
          <td>
            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-sm btn-primary">編集</a>
            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">削除</button>
            </form>
          </td>
          <td>
            <a href="{{ route('admin.movies.show', $movie->id) }}" class="btn btn-secondary btn-sm">映画詳細ページ</a>
            <a href="{{ route('admin.schedules.create', $movie->id) }}">スケジュールを追加</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <a href="{{ route('admin.movies.create') }}" class="btn btn-success mt-3">新規登録</a>
    <a href="{{ route('admin.schedules.index') }}" class="btn btn-info mt-3">上映スケジュール一覧</a>

  </div>

</body>
</html>
