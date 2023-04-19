<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->string('kana')->comment('ふりがな');
            $table->tinyInteger('gender')->comment('性別(0:女性, 1:男性)');
            $table->date('birthday')->comment('生年月日');
            $table->string('post_code')->comment('郵便番号');
            $table->string('prefecture')->comment('都道府県');
            $table->string('municipality')->comment('市区町村');
            $table->string('street_name')->comment('丁目・番地・号');
            $table->string('building')->nullable()->comment('建物名');
            $table->string('phone_number')->comment('電話番号');
            $table->string('mail_address')->comment('メールアドレス');
            $table->string('supporter_id')->comment('サポーターID');
            $table->string('password')->comment('パスワード');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_users');
    }
}
