<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamp('post_at')->comment('投稿日');
            $table->string('job_id')->nullable()->comment('画像/お仕事ID 外部結合でシッター，家事代行を判別');
            $table->tinyInteger('is_publish')->comment('公開するかのフラグ。非公開：0，公開中：1');
            $table->integer('rating')->comment('評価　チェックボックス　なし：0，1つ星：1，2つ星：2，3つ星：3，4つ星：4，5つ星：5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_reviews');
    }
}
