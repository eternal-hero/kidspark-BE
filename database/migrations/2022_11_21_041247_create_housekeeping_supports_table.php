<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousekeepingSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housekeeping_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->text('acceptance_condition')->nullable()->comment('受け入れ条件の説明文');
            $table->unsignedTinyInteger('room_cleaning_bitflag')->comment('部屋掃除のビットフラグ。');
            $table->unsignedTinyInteger('water_cleaning_bitflag')->comment('水回り掃除のビットフラグ。');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('housekeeping_supports');
    }
}
