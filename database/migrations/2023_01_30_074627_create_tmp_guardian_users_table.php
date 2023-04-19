<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpGuardianUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_guardian_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable()->comment('氏');
            $table->string('last_name')->nullable()->comment('名');
            $table->string('first_kana')->nullable()->comment('氏 ふりがな');
            $table->string('last_kana')->nullable()->comment('名 ふりがな');
            $table->string('nickname')->nullable()->comment('ニックネーム');
            $table->tinyInteger('gender')->nullable()->comment('性別(0:女性, 1:男性)');
            $table->string('relation')->nullable()->comment('続柄');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->string('post_code')->nullable()->comment('郵便番号');
            $table->string('prefecture')->nullable()->comment('都道府県');
            $table->string('municipality')->nullable()->comment('市区町村');
            $table->string('street_name')->nullable()->comment('丁目・番地・号');
            $table->string('building')->nullable()->comment('建物名');
            $table->string('contact_phone_number')->nullable()->comment('連絡先電話番号');
            $table->string('mail_address')->comment('メールアドレス');
            $table->string('password')->nullable()->comment('パスワード');
            $table->string('auth_code')->comment('認証コード');
            $table->boolean('email_verified')->default(false)->comment('メール認証');
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
        Schema::dropIfExists('tmp_guardian_users');
    }
}
