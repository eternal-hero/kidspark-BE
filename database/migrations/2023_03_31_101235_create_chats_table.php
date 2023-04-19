<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_room_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('sender')->comment('0:サポーター,1:保護者');
            $table->text('body')->comment('メッセージ内容')->nullable();
            $table->tinyInteger('is_read')->comment('0:未読,1:既読');
            $table->integer('job_status_change')->comment('仕事の状態変更, 1:お仕事リクエストが届きました等')->nullable();
            $table->string('file_path')->nullable()->comment('ファイルパス');
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
        Schema::dropIfExists('chats');
    }
}
