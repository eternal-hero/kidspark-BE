<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('point_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->comment('決済ID');
            $table->bigInteger('job_id')->comment('予約ID');
            $table->integer('point')->comment('ポイント');
            $table->integer('result')->comment('結果');
            $table->timestamp('date')->comment('日付');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_payments');
    }
};
