<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceRecord;
use App\Models\BreakRecord;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $userId = Auth::id();

        // AttendanceRecord テーブルからのデータ取得
        $record = AttendanceRecord::where('user_id', $userId)
                        ->where('date', $today)
                        ->first();

        // Break テーブルからのデータ取得
        $break = BreakRecord::where('user_id', $userId)
                        ->where('date', $today)
                        ->orderBy('updated_at', 'desc') // 最新のデータを取得
                        ->first();

        // 取得レコードに `calculate_break_time` が存在する場合は $break を null にする
        if ($break && $break->calculate_break_time !== null) {
            $break = null;
        }

        // ビューに複数の変数を渡す
        return view('index', compact('record', 'break'));
    }

    public function startWork()
    {
        // 現在時刻を取得し「YYYY-MM-DD」形式の文字列に変換
        $today = now()->toDateString();
        // firstOrCreateで指定した条件でレコードを検索、存在しなければレコードを作成
        $record = AttendanceRecord::firstOrCreate(
            // 条件としてログインユーザーと今日の日付を指定
            ['user_id' => Auth::id(), 'date' => $today],
            // レコードがない場合、勤務開始時刻を現在時刻に設定
            ['start_time' => now()]
        );

        // web.phpでattendance.indexと名付けられたルート名にリダイレクト
        return redirect()->route('attendance.index');
    }

    public function endWork()
    {
        $today = now()->toDateString();
        // レコードを検索。ユーザーIDがログインユーザーと一致（Auth::id() で取得）、日付が今日の条件に一致する最初のレコードを取得する
        $record = AttendanceRecord::where('user_id', Auth::id())
                                    ->where('date', $today)
                                    ->first();
        // 取得に成功した場合（nullでない場合)勤務終了時間をアップデートする
        if ($record) {
            $record->update(['end_time' => now()]);
        }

        return redirect()->route('attendance.index');
    }

    public function startBreak()
    {
        $today = now()->toDateString();
        $userId = Auth::id();

        // 常に新しいレコードを作成し、break_start_time を現在時刻に設定
        BreakRecord::create([
            'user_id' => $userId,
            'date' => $today,
            'break_start_time' => now()
        ]);

        return redirect()->route('attendance.index');
    }

    public function endBreak()
    {
        $today = now()->toDateString();
        $break = BreakRecord::where('user_id', Auth::id())
                                    ->where('date', $today)
                                    ->orderBy('updated_at', 'desc') // 最新のレコードを取得
                                    ->first();
        if ($break) {
        // break_end_time を現在の時刻に設定
        $breakEndTime = now();
        
        // break_start_time が存在する場合にのみ、計算を行う
        if ($break->break_start_time) {
            // 休憩時間を分単位で計算
            $breakDuration = $breakEndTime->diffInMinutes($break->break_start_time);

            // レコードを更新
            $break->update([
                'break_end_time' => $breakEndTime,
                'calculate_break_time' => $breakDuration // 計算された休憩時間を分単位で保存
            ]);
        } else {
            // break_start_time が null の場合でも break_end_time を更新
            $break->update([
                'break_end_time' => $breakEndTime
                // calculate_break_time は null のまま
            ]);
        }
    }

        return redirect()->route('attendance.index');
    }
}
