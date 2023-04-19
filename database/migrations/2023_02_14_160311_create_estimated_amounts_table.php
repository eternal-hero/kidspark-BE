<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatedAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimated_amounts', function (Blueprint $table) {
            $table->id();
            $table->integer('basic_fee')->default(0)->comment('基本料金');
            $table->integer('option_fee')->nullable()->comment('オプション料金');
            $table->integer('transportation_fee')->nullable()->comment('交通費');
            $table->integer('commission_fee')->nullable()->comment('手数料');
            $table->integer('total')->default(0)->comment('合計');
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
        Schema::dropIfExists('estimated_amounts');
    }
}
