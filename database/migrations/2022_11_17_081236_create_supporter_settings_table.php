<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('is_supporter')->comment('シッターをする');
            $table->integer('single_fee')->comment('単発予約料金');
            $table->integer('regular_fee')->comment('定期予約料金');
            $table->text('special')->nullable()->comment('特典設定');
            $table->text('service')->nullable()->comment('サービス説明');
            $table->integer('potential_entrant')->nullable()->comment('受け入れ可能人数。');
            $table->integer('minimum_age_limit')->comment('保育可能年齢の下限。単位は「月」（12×歳 + ヶ月）');
            $table->integer('maximum_age_limit')->comment('保育可能年齢の上限。単位は「月」（12×歳 + ヶ月）');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_settings');
    }
}
