<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_user_id')->comment('保護者ID');
            $table->text('title')->comment('タイトル');
            $table->tinyInteger('type')->comment('内容の種類 (1:シッター, 2:家庭教師, 3:家事代行, 4:産前産後)');
            $table->boolean('is_single')->comment('定期/単発 (0:単発, 1:定期)');
            $table->date('childcare_on')->comment('預けたい日');
            $table->time('support_time_start')->comment('サポート開始時間');
            $table->time('support_time_end')->comment('サポート終了時間');
            $table->text('detail')->comment('仕事内容詳細');
            $table->integer('fee_limit')->comment('時給上限');
            $table->integer('transportation_expenses_limit')->comment('交通費上限');
            $table->string('place')->comment('サポート場所（市町村）');
            $table->string('near_station')->comment('最寄り駅');
            $table->dateTime('period_at')->comment('募集期限');
            $table->tinyInteger('status')->comment('ステータス (-1: キャンセル, 0:募集終了, 1:募集中)');
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
        Schema::dropIfExists('publish_applications');
    }
}
