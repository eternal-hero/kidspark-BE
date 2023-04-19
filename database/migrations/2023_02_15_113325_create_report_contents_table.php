<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->comment('仕事予約ID');
            $table->tinyInteger('contents_type')->comment('項目の種類');
            $table->text('contents_detail')->comment('項目毎の内容');
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
        Schema::dropIfExists('report_contents');
    }
}
