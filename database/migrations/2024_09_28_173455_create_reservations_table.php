<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // ID
            $table->date('date'); // 上映日
            $table->unsignedBigInteger('schedule_id'); // スケジュールID
            $table->unsignedBigInteger('sheet_id'); // シートID
            $table->string('email'); // 予約者メールアドレス
            $table->string('name'); // 予約者名
            $table->boolean('is_canceled')->default(false); // 予約キャンセル済み
            $table->timestamps(); // 作成日時・更新日時

            // 複合ユニークキーを追加
            $table->unique(['schedule_id', 'sheet_id', 'date']);
            // 外部キー制約を追加（必要に応じて）
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->foreign('sheet_id')->references('id')->on('sheets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
