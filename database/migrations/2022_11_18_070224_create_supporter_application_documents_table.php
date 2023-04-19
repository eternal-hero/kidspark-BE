<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterApplicationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_application_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->unsignedBigInteger('file_id')->comment('ファイルのID');
            $table->tinyInteger('status')->comment('申請・提出書類のステータス。（未対応、など）');
            $table->text('memo')->nullable()->comment('メモ');
            $table->tinyInteger('category')->comment('本人確認・資格証書のカテゴリー。');
            $table->string('application_name')->comment('本人確認・資格証書の名称。');
            $table->timestamp('application_at')->comment('申請日時。表示は時間(YYmmdd hhMM)まで');
            $table->date('expiration_on')->comment('有効期限。表示はYYmmdd');
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
        Schema::dropIfExists('supporter_application_documents');
    }
}
