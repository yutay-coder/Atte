@extends('layouts.app')

@section('content')
    <h1>打刻ページ</h1>

    @if ($record)
        <p>勤務開始: {{ $record->start_time }}</p>
        <p>勤務終了: {{ $record->end_time }}</p>
        @if ($break)
            <p>休憩開始: {{ $break->break_start_time }}</p>
            <p>休憩終了: {{ $break->break_end_time }}</p>
        @endif
    @endif

    <!-- 勤務開始ボタンを常に表示 -->
    <form action="{{ route('attendance.startWork') }}" method="POST">
        @csrf
        <button type="submit" class="{{ isset($record) && $record->start_time ? 'disabled' : '' }}"
                {{ isset($record) && $record->start_time ? 'disabled' : '' }}>
            勤務開始
        </button>
    </form>

    <!-- 勤務終了ボタンを常に表示 -->
    <form action="{{ route('attendance.endWork') }}" method="POST">
        @csrf
        <button type="submit" class="{{ isset($record) && $record->start_time && !$record->end_time && !(isset($break) && $break->break_start_time) ? '' : 'disabled' }}"
                {{ !(isset($record) && $record->start_time && !$record->end_time && !(isset($break) && $break->break_start_time)) ? 'disabled' : '' }}>
            勤務終了
        </button>
    </form>

    <!-- 休憩開始ボタンを常に表示 -->
    <form action="{{ route('attendance.startBreak') }}" method="POST">
        @csrf
        <button type="submit" class="{{ isset($record) && $record->start_time && !$record->end_time && !(isset($break) && $break->break_start_time) ? '' : 'disabled' }}" {{ !(isset($record) && $record->start_time && !$record->end_time && !(isset($break) && $break->break_start_time)) ? 'disabled' : '' }}>
            休憩開始
        </button>
    </form>

    <!-- 休憩終了ボタンを常に表示 -->
    <form action="{{ route('attendance.endBreak') }}" method="POST">
        @csrf
        <button type="submit" class="{{ !(isset($break) && $break->break_start_time && !$break->break_end_time) ? 'disabled' : '' }}" {{ !(isset($break) && $break->break_start_time && !$break->break_end_time) ? 'disabled' : '' }}>
            休憩終了
        </button>
    </form>

@endsection
