<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->timestamp('support_start_at')->comment('サポート開始時間');
            $table->timestamp('support_end_at')->comment('サポート終了時間');
            $table->integer('total')->comment('合計金額');
            $table->tinyInteger('is_approval')->default(0)->comment('承認の有無');
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
        Schema::dropIfExists('pre_quotations');
    }
}
