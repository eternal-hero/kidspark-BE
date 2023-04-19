<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_verification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->tinyInteger('status')->comment('ステータス (0: 未対応, 1: 有効)');
            $table->text('memo')->nullable()->comment('メモ');
            $table->tinyInteger('title')->comment('名称 (1:運転免許証, 2:健康保険証, 3:マイナンバーカード, 4:住基カード, 5:在留カード, 6:住民票の写し)');
            $table->dateTime('request_at')->comment('申請日時');
            $table->date('expiration_on')->comment('有効期限');
            $table->string('additional_file_path')->comment('補助書類');
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
        Schema::dropIfExists('identity_verification');
    }
}
