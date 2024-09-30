<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約一覧</title>
</head>
<body>
    <a href="{{ route('admin.reservations.create') }}">追加</a>
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>座席</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ strtoupper($reservation->sheet->row) }}{{ $reservation->sheet->column }}</td>
                    <td><a href="{{ route('admin.reservations.edit', ['id' => $reservation->id]) }}">編集</a></td>
                    <td>
                        <form action="{{ route('admin.reservations.destroy', ['id' => $reservation->id]) }}" method="post"
                            onsubmit="return confirm('本当に削除しますか?')">
                            @csrf
                            @method('delete')
                            <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">予約がありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
