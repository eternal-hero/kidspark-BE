<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKidsparkRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kidspark_revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->integer('supporter_commision_fee')->comment('サポーター手数料(金額)');
            $table->integer('supporter_commision_percentage')->comment('サポーター手数料(割合)※「%」表記');
            $table->integer('guardian_commision_fee')->comment('保護者手数料(金額)');
            $table->integer('guardian_commision_percentage')->comment('保護者手数料(割合)※「%」表記');
            $table->integer('total')->comment('合計金額');
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kidspark_revenues');
    }
}
