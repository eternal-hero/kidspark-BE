<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_area', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->integer('prefecture')->comment('都道府県');
            $table->text('area')->comment('対応エリア');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_area');
    }
}
