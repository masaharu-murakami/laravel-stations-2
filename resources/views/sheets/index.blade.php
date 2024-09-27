<!-- resources/views/sheets/index.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>座席表</title>
</head>
<body>
    <h1>座席表</h1>
    <p>スクリーン</p>
    <table border="1">
        @foreach (['a', 'b', 'c'] as $row)
            <tr>
                @foreach ($sheets->where('row', $row) as $sheet)
                    <td>{{ $row }}-{{ $sheet->column }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>
