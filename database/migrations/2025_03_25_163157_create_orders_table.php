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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('order_no', 20)->unique('order_no');
            $table->integer('user_id');
            $table->mediumInteger('total_price')->nullable();
            $table->string('status', 20)->default('unpaid');
            $table->string('receivers', 25);
            $table->string('phone', 15);
            $table->string('address', 100);
            $table->smallInteger('zipcode');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['order_no'], 'order_no_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
