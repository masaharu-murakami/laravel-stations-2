<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id(); // IDカラムを自動生成
            $table->string('name')->unique(); // ジャンル名を格納するカラム
            $table->timestamps(); // created_at と updated_at カラムを自動生成
        });
    }

    public function down()
    {
        Schema::dropIfExists('genres'); // ジャンルテーブルを削除
    }
}
