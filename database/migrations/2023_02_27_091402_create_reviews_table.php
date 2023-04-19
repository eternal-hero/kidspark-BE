<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->comment('仕事予約ID');
            $table->bigInteger('reviewer_id')->comment('レビュアーID');
            $table->tinyInteger('reviewer_type')->comment('レビュアーの種類');
            $table->tinyInteger('icon')->default(0)->comment('レビューアイコン');
            $table->integer('rating')->default(0)->comment('評価');
            $table->text('review_content')->nullable()->comment('レビュー本文');
            $table->timestamp('post_at')->comment('投稿日');
            $table->tinyInteger('is_publish')->default(0)->comment('公開するかのフラグ');
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
        Schema::dropIfExists('reviews');
    }
}
