<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRequiredFieldsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('guardian_profiles', function (Blueprint $table) {
            $table->text('way_to_get_home')->nullable()->change();
            $table->unsignedBigInteger('inoculation_status_id')->nullable()->change();
            $table->text('title')->nullable()->change();
            try {
                $table->unique('guardian_user_id');
            } catch (Exception $e) {}
        });
        Schema::table('inoculation_status', function (Blueprint $table) {
            $table->date('inoculation_on')->comment('最新接種日付')->nullable()->change();
        });

        Schema::table('guardian_users', function (Blueprint $table) {
            $table->string('housing_type')->comment('住所形態')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('guardian_profiles', function (Blueprint $table) {
            $table->text('way_to_get_home')->nullable(false)->default('')->change();
            $table->text('title')->nullable(false)->default('')->change();
            try {
                $table->dropUnique(['guardian_user_id']);
            } catch (Exception $e) {}
        });
        Schema::table('inoculation_status', function (Blueprint $table) {
            $table->date('inoculation_on')->comment('最新接種日付')->nullable(false)->change();
        });
        Schema::table('guardian_users', function (Blueprint $table) {
            $table->string('housing_type')->comment('住所形態')->nullable(false)->default('')->change();
        });
    }
}
