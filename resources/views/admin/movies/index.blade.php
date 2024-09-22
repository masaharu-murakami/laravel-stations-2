<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>映画一覧</title>
</head>
<body>
  <h1>映画一覧</h1>
  <table>
    <thead>
      <tr>
        <th>映画のタイトル</th>
        <th>映画URL</th>
        <th>公開年</th>
        <th>上映状況</th>
        <th>概要</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>
      <a href="{{ route('admin.create') }}">登録画面</a>
      <a href="{{ route('admin.movies.index') }}">一覧</a>
</body>
</html>