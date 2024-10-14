<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use App\Models\BreakRecord;
use Carbon\Carbon;

class ItemListController extends Controller
{
    public function index(Request $request)
    {
        // 日付を取得（指定がない場合は今日の日付）
        $date = $request->input('date', Carbon::today()->toDateString());

        // 勤怠データを取得
        $attendances = AttendanceRecord::with('user')
            ->where('date', $date)
            ->paginate(5);

        // 休憩時間を計算
        foreach ($attendances as $attendance) {
            $breakTime = BreakRecord::where('user_id', $attendance->user_id)
                ->where('date', $attendance->date)
                ->sum('calculate_break_time');
            $attendance->break_time = $breakTime;
            // 勤務時間の計算
            $attendance->work_time = $this->calculateWorkTime($attendance);
        }

        return view('attendance', compact('attendances', 'date'));
    }

    private function calculateWorkTime($attendance)
    {
        if ($attendance->start_time && $attendance->end_time) {
            $start = \Carbon\Carbon::parse($attendance->start_time);
            $end = \Carbon\Carbon::parse($attendance->end_time);
            $workTimeMinutes = $end->diffInMinutes($start) - $attendance->break_time;
            return max(0, $workTimeMinutes); // 0未満にならないように
        }
        return 0; // 勤務開始または終了がない場合
    }

    public function changeDate(Request $request, $direction)
    {
        // 日付の変更
        $date = Carbon::parse($request->input('date'));
        $newDate = $direction === 'prev' ? $date->subDay() : $date->addDay();

        return redirect()->route('itemList.index', ['date' => $newDate->toDateString()]);
    }
}
