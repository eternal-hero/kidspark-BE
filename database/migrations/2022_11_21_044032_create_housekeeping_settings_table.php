<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousekeepingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housekeeping_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('is_housework')->comment('家事代行フラグ。家事代行しない：0，家事代行する：1');
            $table->integer('single_fee')->comment('単発予約の料金。単位は「円/時」');
            $table->integer('regular_fee')->comment('定期予約の料金。単位は「円/時」');
            $table->text('special')->nullable()->comment('特典設定の説明');
            $table->text('service')->nullable()->comment('サービス説明');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('housekeeping_settings');
    }
}
