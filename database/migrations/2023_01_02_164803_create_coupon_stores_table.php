<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_stores', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('coupon_code');
            $table->integer('discount_method');
            $table->integer('discount_amount');
            $table->integer('discount_range')->nullable();
            $table->integer('lowest_total_amount')->nullable();
            $table->dateTime('validity_date');
            $table->string('added_by');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('coupon_stores');
    }
};
