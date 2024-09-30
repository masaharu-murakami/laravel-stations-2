<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->integer('column');
            $table->string('row', 255);
            $table->timestamps();

            // 外部キー制約を追加する場合は以下を有効にします
            // $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            // $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('sheets', function (Blueprint $table) {
        //     // カラムを削除
        //     $table->dropForeign(['movie_id']);
        //     $table->dropForeign(['schedule_id']);
        //     $table->dropColumn(['movie_id', 'schedule_id']);
        // });

        Schema::dropIfExists('sheets');
    }
}
