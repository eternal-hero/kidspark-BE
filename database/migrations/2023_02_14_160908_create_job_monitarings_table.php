<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobMonitaringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_monitarings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->tinyInteger('is_monitarings')->default(0)->comment('見守りモニタリング依頼');
            $table->string('user_name')->comment('Ezvizユーザ名');
            $table->string('password')->comment('Ezvizパスワード');
            $table->text('note')->nullable()->comment('備考');
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
        Schema::dropIfExists('job_monitarings');
    }
}
