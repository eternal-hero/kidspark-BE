<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_at')->comment('予約の開始日時');
            $table->timestamp('end_at')->nullable()->comment('予約の終了日時');
            $table->bigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->bigInteger('guardian_user_id')->comment('ユーザ名　ユーザに紐づく');
            $table->tinyInteger('regular_or_single_flag')->comment('定期/単発の判定フラグ　単発：0，定期：1');
            $table->tinyInteger('contents_type')->comment('内容の種類。セレクター');
            $table->tinyInteger('is_watch_over')->comment('見守りフラグ　なし：0，あり：1');
            $table->integer('reservation_status')->comment('予約状況のステータス');
            $table->text('memo')->nullable()->comment('メモ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_reservations');
    }
}
