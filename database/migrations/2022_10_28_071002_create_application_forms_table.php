<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->tinyInteger('status')->comment('ステータス (-1: 不受理, 0:未対応, 1:対応済み)');
            $table->text('memo')->comment('メモ');
            $table->date('updated_at')->comment('最終更新日時');
            $table->string('subject')->comment('申請件名');
            $table->string('sender')->comment('送信者');
            $table->bigInteger('member_id')->comment('会員ID');
            $table->text('detail')->comment('内容');
            $table->string('file_path')->comment('ファイルパス');
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
        Schema::dropIfExists('application_forms');
    }
}
