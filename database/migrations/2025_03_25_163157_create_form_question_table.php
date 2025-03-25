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
        Schema::create('form_question', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('question');
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->tinyInteger('title_id');
            $table->tinyInteger('goal_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_question');
    }
};
