<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->unsignedBigInteger('inoculation_status_id')->comment('ワクチン接種状況テーブルID');
            $table->text('title')->comment('タイトル');
            $table->text('self_introduction')->comment('自己紹介文');
            $table->string('near_line')->comment('最寄り路線');
            $table->string('near_station')->comment('最寄り駅');
            $table->tinyInteger('means')->comment('最寄り駅からの交通手段');
            $table->integer('travel_times')->comment('最寄り駅からの所要時間');
            $table->tinyInteger('is_publish')->comment('最寄り駅の公開');
            $table->integer('time_between_appointment')->comment('予約前後空き時間');
            $table->integer('minimum_request_time')->comment('最低依頼時間目安');
            $table->integer('reply_time')->comment('返答までの時間');
            $table->tinyInteger('is_foreign_language')->comment('外国語対応');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_profiles');
    }
}
