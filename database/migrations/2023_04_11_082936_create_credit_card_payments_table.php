<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('credit_card_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_id')->comment('決済ID');
            $table->bigInteger('job_id')->comment('予約ID');
            $table->integer('amount')->comment('金額');
            $table->integer('payment_fee')->comment('決済手数料');
            $table->text('result')->comment('結果');
            $table->text('note')->comment('備考');
            $table->timestamp('date')->comment('日付');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_card_payments');
    }
};
