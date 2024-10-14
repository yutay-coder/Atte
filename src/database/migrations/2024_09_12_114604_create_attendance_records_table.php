<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            // users テーブルの id カラムを参照する外部キー,usersテーブルの該当ユーザーが削除されたとき自動削除
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date'); // 勤務日
            $table->timestamp('start_time')->nullable(); // 勤務開始
            $table->timestamp('end_time')->nullable(); // 勤務終了
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_records');
    }
}
