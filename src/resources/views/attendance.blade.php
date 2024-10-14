@extends('layouts.app')

@section('content')
    <h1>{{ $date }} の日別勤怠データ一覧</h1>

    <form action="{{ route('itemList.changeDate', 'prev') }}" method="POST" style="display: inline;">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <button type="submit">&laquo; 前日</button>
    </form>
    
    <form action="{{ route('itemList.changeDate', 'next') }}" method="POST" style="display: inline;">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <button type="submit">翌日 &raquo;</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ユーザー名</th>
                <th>勤務開始時間</th>
                <th>勤務終了時間</th>
                <th>休憩時間 (分)</th>
                <th>勤務時間 (分)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->start_time ? \Carbon\Carbon::parse($attendance->start_time)->format('H:i') : '未打刻' }}</td>
                    <td>{{ $attendance->end_time ? \Carbon\Carbon::parse($attendance->end_time)->format('H:i') : '未打刻' }}</td>
                    <td>{{ $attendance->break_time }}</td>
                    <td>{{ $attendance->work_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $attendances->links() }} <!-- ページネーション -->
@endsection
