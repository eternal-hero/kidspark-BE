<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositWithdrawalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_withdrawal_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->date('date_on')->comment('入出金の日付');
            $table->text('content')->comment('内容');
            $table->integer('amount')->comment('金額。');
            $table->integer('status')->comment('入出金のステータス');
            $table->tinyInteger('is_deposit_withdrawal')->comment('入金/出金の判定フラグ　入金：0，出金：1');
            $table->text('remark')->nullable()->comment('備考');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit_withdrawal_histories');
    }
}
