@foreach($sheetList as $sheetRow)
    <tr>
        @foreach($sheetRow as $sheetCol)
            <td>{{ $sheetCol['id'] }}</td>  <!-- 座席のIDを表示 -->
            <td>{{ $sheetCol['name'] }}</td>  <!-- 座席の名前を表示 -->
        @endforeach
    </tr>
@endforeach
