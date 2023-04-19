<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHousekeepingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('housekeeping_supports', function (Blueprint $table) {
            $table->dropColumn('room_cleaning_bitflag');
            $table->dropColumn('water_cleaning_bitflag');
            $table->string('supported_service')->nullable()->after('acceptance_condition')->comment('対応可能サービス 「,」区切り');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('housekeeping_supports', function (Blueprint $table) {
            $table->unsignedTinyInteger('room_cleaning_bitflag')->comment('部屋掃除のビットフラグ。')->after('acceptance_condition');
            $table->unsignedTinyInteger('water_cleaning_bitflag')->comment('水回り掃除のビットフラグ。')->after('room_cleaning_bitflag');
            $table->dropColumn('supported_service');
        });
    }
}
