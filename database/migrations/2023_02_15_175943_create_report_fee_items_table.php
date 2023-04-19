<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportFeeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_fee_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->comment('報告書ID');
            $table->tinyInteger('item_type')->comment('項目の種類');
            $table->integer('fee')->default(0)->comment('金額');
            $table->string('detail')->nullable()->comment('内訳、詳細など');
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
        Schema::dropIfExists('report_fee_items');
    }
}
