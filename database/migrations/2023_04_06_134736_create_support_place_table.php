<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_place', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs');
            $table->string('address')->nullable()->comment('住所');
            $table->string('near_line')->comment('最寄り駅 路線名');
            $table->string('near_station')->comment('最寄り駅 駅名');
            $table->integer('means')->comment('最寄り駅までの交通手段');
            $table->integer('travel_time')->comment('最寄り駅までの所要時間');
            $table->integer('way_to_get_home')->comment('サポート場所までの行き方');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('support_place');
    }
}
