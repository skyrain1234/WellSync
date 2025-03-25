<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->integer('user_id')->primary()->comment('用戶id');
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('0:女生
1:男生');
            $table->date('birthday');
            $table->integer('occupation_id')->comment('職業');
            $table->tinyInteger('ever_take')->comment('曾經服用保健食品 0:無
1:有');
            $table->integer('on_medication')->comment('正在服用的保健食品數量');
            $table->integer('frequency')->comment('服用保健食品的頻率');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_info');
    }
};
