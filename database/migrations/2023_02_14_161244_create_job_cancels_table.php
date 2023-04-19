<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCancelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_cancels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->tinyInteger('applicant_type')->comment('申請者の種類');
            $table->bigInteger('applicant_id')->comment('申請者のID');
            $table->tinyInteger('status')->default(0)->comment('キャンセルのステータス');
            $table->tinyInteger('reason')->nullable()->comment('キャンセル理由');
            $table->timestamp('date')->comment('キャンセル日時');
            $table->text('reason_detail')->comment('キャンセル理由詳細');
            $table->integer('fee')->default(0)->comment('キャンセル金額');
            $table->tinyInteger('confirmation_bitflag')->default(0)->comment('確認事項ビットフラグ');
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
        Schema::dropIfExists('job_cancels');
    }
}
