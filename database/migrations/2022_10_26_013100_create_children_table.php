<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->string('name')->comments('名前');
            $table->string('kana')->comment('ふりがな');
            $table->tinyInteger('gender')->comment('性別(0:女性, 1:男性)');
            $table->string('nickname')->comment('愛称');
            $table->date('birthday')->comment('生年月日');
            $table->string('allergy')->nullable()->comment('アレルギー');
            $table->string('chronic_disease')->nullable()->comment('持病');
            $table->text('other')->nullable()->comment('その他/配慮事項');
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
        Schema::dropIfExists('children');
    }
}
