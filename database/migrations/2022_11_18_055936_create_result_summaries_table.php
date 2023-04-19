<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->integer('job_count')->comment('お仕事回数。単位は「回」');
            $table->integer('follower_count')->comment('フォロワー数。単位は「人」');
            $table->integer('repeat_user_count')->comment('リピートユーザー数。単位は「人」');
            $table->integer('booking_completion_rate')->comment('予約成立数。単位は「%」');
            $table->integer('response_rate')->comment('返信率。単位は「%」');
            $table->integer('last_minute_cancellation_rate')->comment('直前キャンセル率。単位は「%」');
            $table->date('record_on')->comment('年月。DATE型に合わせてYYmmdd形式で、年月を登録。ddは00で統一');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_summaries');
    }
}
