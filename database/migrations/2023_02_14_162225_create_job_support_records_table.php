<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSupportRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_support_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->timestamp('support_preparation_at')->nullable()->comment('サポート準備完了時間');
            $table->timestamp('support_start_at')->nullable()->comment('サポート開始時間');
            $table->timestamp('support_end_at')->nullable()->comment('サポート終了時間');
            $table->timestamp('report_send_at')->nullable()->comment('レポート提出時間');
            $table->timestamp('report_approval_at')->nullable()->comment('レポート承認時間');
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
        Schema::dropIfExists('job_support_records');
    }
}
