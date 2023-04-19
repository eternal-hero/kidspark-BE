<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_notice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->tinyInteger('is_reserve')->comment('予約依頼メール (0:受け取らない, 1:受け取る)');
            $table->tinyInteger('is_bbs')->comment('掲示板お仕事通知 (0:受け取らない, 1:受け取る)');
            $table->tinyInteger('is_message')->comment('保護者からのメッセージ (0:受け取らない, 1:受け取る)');
            $table->tinyInteger('is_kidspark')->comment('キッズパークからのお知らせ (0:受け取らない, 1:受け取る)');
            //$table->timestamps();
            $table->foreign('guardian_user_id')->references('id')->on('guardian_users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian_notice');
    }
}
