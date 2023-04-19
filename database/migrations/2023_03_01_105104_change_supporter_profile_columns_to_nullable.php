<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeSupporterProfileColumnsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('inoculation_status_id')->nullable(true)->change();
            $table->string('near_station')->nullable(true)->change();
            $table->string('near_line')->nullable(true)->change();
            $table->integer('travel_times')->nullable(true)->change();
            $table->integer('time_between_appointment')->nullable(true)->change();
            $table->integer('minimum_request_time')->nullable(true)->change();
            $table->integer('reply_time')->nullable(true)->change();

            DB::statement('alter table supporter_profiles modify column means tinyint null');
            DB::statement('alter table supporter_profiles modify column is_publish tinyint null');
            DB::statement('alter table supporter_profiles modify column is_foreign_language tinyint null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporter_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('inoculation_status_id')->nullable(false)->change();
            $table->string('near_station')->nullable(false)->change();
            $table->string('near_line')->nullable(false)->change();
            $table->integer('travel_times')->nullable(false)->change();
            $table->integer('time_between_appointment')->nullable(false)->change();
            $table->integer('minimum_request_time')->nullable(false)->change();
            $table->integer('reply_time')->nullable(false)->change();

            DB::statement('alter table supporter_profiles modify column means tinyint not null');
            DB::statement('alter table supporter_profiles modify column is_publish tinyint not null');
            DB::statement('alter table supporter_profiles modify column is_foreign_language tinyint not null');

        });
    }
}
