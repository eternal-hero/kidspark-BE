<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->string('kana')->comment('ふりがな');
            $table->string('nickname')->comment('ニックネーム');
            $table->tinyInteger('gender')->comment('性別(0:女性, 1:男性)');
            $table->string('relation')->comment('続柄');
            $table->date('birthday')->comment('生年月日');
            $table->string('post_code')->comment('郵便番号');
            $table->string('prefecture')->comment('都道府県');
            $table->string('municipality')->comment('市区町村');
            $table->string('street_name')->comment('丁目・番地・号');
            $table->string('building')->nullable()->comment('建物名');
            $table->string('contact_phone_number')->comment('連絡先電話番号');
            $table->string('mail_address')->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->string('workspace')->nullable()->comment('勤務先');
            $table->string('family_structure')->comment('家族構成');
            $table->boolean('is_pets')->comment('ペットの有無 (0:無, 1:有)');
            $table->string('housing_type')->comment('住所形態');
            $table->boolean('is_camera')->comment('カメラ設置 (0:無, 1:有)');
            $table->string('emergency_contact_name')->comment('緊急連絡先の名前');
            $table->string('emergency_contact_phone_number')->comment('緊急連絡先の電話番号');
            $table->string('emergency_contact_relation')->comment('登録者との関係');
            $table->tinyInteger('status')->comment('ステータス');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian_users');
    }
}
