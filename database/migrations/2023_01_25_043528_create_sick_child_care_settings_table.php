<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSickChildCareSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sick_child_care_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('is_sick_child_care')->comment('病児保育をするフラグ');
            $table->integer('single_fee')->comment('単発予約料金');
            $table->integer('regular_fee')->comment('定期予約料金');
            $table->text('special')->nullable()->comment('特典設定');
            $table->text('service')->nullable()->comment('サービス説明');
            $table->timestamps();
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
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
        Schema::dropIfExists('sick_child_care_settings');
    }
}
