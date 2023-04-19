<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_sales', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->comment('お仕事ID');
            $table->timestamp('support_at')->comment('仕事の開始日　表示はYYmmdd');
            $table->timestamp('settlement_at')->comment('決済日表示　時間まで表示');
            $table->string('content_type')->comment('仕事内容の種類');
            $table->integer('amount_total')->comment('内訳の合計');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_sales');
    }
}
