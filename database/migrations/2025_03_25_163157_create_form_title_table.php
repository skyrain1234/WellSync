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
        Schema::create('form_title', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('title_name');
            $table->boolean('weight_1');
            $table->boolean('weight_2');
            $table->boolean('weight_3');
            $table->boolean('weight_4');
            $table->boolean('weight_5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_title');
    }
};
