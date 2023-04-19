<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->tinyInteger('request_category')->comment('依頼カテゴリー');
            $table->tinyInteger('request_content')->comment('予約内容');
            $table->date('support_date_on')->comment('予約希望日');
            $table->timestamp('support_start_at')->comment('仕事開始時間');
            $table->timestamp('support_end_at')->comment('仕事終了時間');
            $table->text('detail')->nullable()->comment('具体的な依頼内容');
            $table->integer('is_monutarings')->default(0)->comment('見守りモニタリング依頼フラグ');
            $table->foreignId('estimated_amounts_id')->comment('予約金額明細ID');
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
        Schema::dropIfExists('job_requests');
    }
}
