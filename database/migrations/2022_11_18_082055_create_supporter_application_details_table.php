<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_application_details', function (Blueprint $table) {
            $table->id()->comment('申請ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('status')->comment('申請のステータス');
            $table->text('memo')->comment('メモ');
            $table->timestamp('update_at')->comment('申請の最終更新日');
            $table->string('subject')->comment('申請の件名');
            $table->string('sender')->comment('送信者');
            $table->string('member_id')->comment('会員ID');
            $table->text('detail')->comment('申請の内容');
            $table->text('file_path')->comment('アップロードされたファイルが格納されている場所のパス');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_application_details');
    }
}
