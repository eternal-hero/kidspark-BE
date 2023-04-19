<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterApplicationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_application_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id')->comment('申請ID　申請提出詳細の申請IDに紐づく');
            $table->timestamp('update_at')->comment('申請の更新日時');
            $table->string('administrator')->comment('申請の管理者　編集した人');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_application_histories');
    }
}
