<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationFeeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_fee_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->comment('見積書ID');
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
        Schema::dropIfExists('quotation_fee_items');
    }
}
