<div class="container">
    <h1>{{ $movie->title }}</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" style="max-width: 100%; height: auto;">
    <p>{{ $movie->description }}</p>
    <p>公開年: {{ $movie->published_year }}</p>
    <p>ステータス: {{ $movie->is_showing ? '上映中' : '上映予定' }}</p>

    <h2>上映スケジュール</h2>
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px; text-align: left;">開始時刻</th>
                <th style="padding: 8px; text-align: left;">終了時刻</th>
            </tr>
        </thead>
        <tbody>
            @if($schedules->isEmpty())
                <tr>
                    <td colspan="2" style="text-align: center;">スケジュールは設定されていません。</td>
                </tr>
            @else
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->start_time->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $schedule->end_time->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <a href="{{ route('admin.schedules.create', $movie->id) }}">スケジュールを追加</a>
</div>
