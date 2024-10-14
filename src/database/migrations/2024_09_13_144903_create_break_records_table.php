<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('break_records', function (Blueprint $table) {
            $table->id();
            // users テーブルの id カラムを参照する外部キー,usersテーブルの該当ユーザーが削除されたとき自動削除
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date'); // 勤務日
            $table->timestamp('break_start_time')->nullable(); // 休憩開始
            $table->timestamp('break_end_time')->nullable(); // 休憩終了
            $table->integer('calculate_break_time')->nullable(); // 休憩終了ー休憩開始
            // created_at と updated_at の2つのカラムを追加
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
        Schema::dropIfExists('break_records');
    }
}
