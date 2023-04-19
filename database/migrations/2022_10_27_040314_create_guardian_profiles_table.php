<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->unsignedBigInteger('inoculation_status_id')->comment('ワクチン接種状況テーブルID');
            $table->text('title')->comment('タイトル');
            $table->text('self_introduction')->comment('自己紹介文');
            $table->string('near_line')->comment('最寄り路線');
            $table->string('near_station')->comment('最寄り駅');
            $table->tinyInteger('means')->comment('最寄り駅までの移動手段 (1:徒歩, 2:バス, 3:自転車, 4:自家用車, 5:その他)');
            $table->Integer('travel_time')->comment('最寄り駅までの所要時間');
            $table->tinyInteger('is_publish')->comment('最寄り駅の公開');
            $table->text('rule')->nullable()->comment('ご家庭のルール');
            //$table->timestamps();
            $table->foreign('guardian_user_id')->references('id')->on('guardian_users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian_profiles');
    }
}
