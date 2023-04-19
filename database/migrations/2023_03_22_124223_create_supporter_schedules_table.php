<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supporter_user_id')->comment('パークサポーターID');
            $table->date('working_date')->comment('勤務日');
            $table->time('start_at')->nullable()->comment('サポート開始時間');
            $table->time('end_at')->nullable()->comment('サポート終了時間');
            $table->tinyInteger('is_available_all_day')->comment('0:終日不可, 1:予約可');
            $table->tinyInteger('is_reservable')->default(0)->comment('0:予約不可,1:予約可');
            $table->timestamps();
        });
        Schema::table('supporter_schedules', function (Blueprint $table) {
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
        Schema::table('supporter_schedules', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::dropIfExists('supporter_schedules');
    }
}
