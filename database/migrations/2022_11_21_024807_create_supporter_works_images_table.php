<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterWorksImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_works_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('display_status')->comment('表示ステータス。非公開：0，公開中：1');
            $table->text('note')->nullable()->comment('メモ。');
            $table->integer('category')->comment('カテゴリー。セレクターに対応する値が格納される。');
            $table->string('image_path')->nullable()->comment('画像/動画が格納されている場所のパス');
            $table->timestamp('update_at')->comment('最終更新日。');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_works_images');
    }
}
