<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('parenting_experience')->comment('子育て経験フラグ。なし：0，あり：1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_experience');
    }
}
