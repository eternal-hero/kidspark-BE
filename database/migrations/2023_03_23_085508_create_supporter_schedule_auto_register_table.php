<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterScheduleAutoRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_schedule_auto_register', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supporter_user_id')->comment('パークサポーターID');
            $table->integer('day_of_week')->comment('曜日0:日,1:月,...,6:土');
            $table->time('start_at')->nullable()->comment('サポート開始時間');
            $table->time('end_at')->nullable()->comment('サポート終了時間');
            $table->tinyInteger('is_available_all_day')->comment('0:終日不可,1:予約可');
            $table->timestamps();
        });
        Schema::table('supporter_schedule_auto_register', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporter_schedule_auto_register', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::dropIfExists('supporter_schedule_auto_register');
    }
}
