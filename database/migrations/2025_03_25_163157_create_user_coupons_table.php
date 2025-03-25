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
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->integer('user_coupon_id', true);
            $table->integer('user_id')->index('user_coupons_ibfk_1');
            $table->integer('coupon_id')->index('coupon_id');
            $table->tinyInteger('status')->default(0);
            $table->timestamp('received_at')->nullable()->useCurrent();
            $table->timestamp('used_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_coupons');
    }
};
