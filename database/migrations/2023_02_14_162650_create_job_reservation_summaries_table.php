<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReservationSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_reservation_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->timestamp('start_at')->comment('開始時間');
            $table->timestamp('end_at')->comment('終了時間');
            $table->tinyInteger('job_content')->comment('予約内容');
            $table->tinyInteger('request_category')->comment('依頼カテゴリー');
            $table->foreignId('monitaring_id')->nullable()->comment('見守りモニタリング依頼ID');
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
        Schema::dropIfExists('job_reservation_summaries');
    }
}
