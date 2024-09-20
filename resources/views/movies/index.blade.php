<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>映画一覧</title>
</head>
<body>
  <h1>映画一覧</h1>
  <ul>
    @foreach ($movies as $movie)
      <li>
        <h2>{{ $movie->title }}</h2>
        <img src="{{  $movie->image_url }}" alt="{{ $movie->title }}" width="200" height="300">
      </li>
    @endforeach
  </ul>
</body>
</html>