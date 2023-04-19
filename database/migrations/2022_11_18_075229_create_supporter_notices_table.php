<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_notices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('is_request')->comment('リクエスト通知の受け取りフラグ。受け取らない：0，受け取る：1');
            $table->tinyInteger('is_task')->comment('掲示板お仕事通知の受け取りフラグ。受け取らない：0，受け取る：1');
            $table->tinyInteger('is_management')->comment('運営からのお知らせの受け取りフラグ。受け取らない：0，受け取る：1');
            $table->tinyInteger('is_parent')->comment('保護者からのメッセージの受け取りフラグ。受け取らない：0，受け取る：1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_notices');
    }
}
