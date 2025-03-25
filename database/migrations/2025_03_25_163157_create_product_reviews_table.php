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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->comment('使用者評論');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('user_id');
            $table->string('review');
            $table->string('rating');
            $table->boolean('status');
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
