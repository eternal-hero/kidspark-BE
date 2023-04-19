<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->string('job_reservation_id')->nullable()->comment('お仕事ID');
            $table->tinyInteger('content')->comment('内容');
            $table->integer('point')->comment('獲得/利用ポイント');
            $table->date('point_on')->comment('ポイント付与日');
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
        Schema::dropIfExists('points');
    }
}
