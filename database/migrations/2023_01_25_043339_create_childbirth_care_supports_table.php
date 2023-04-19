<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildbirthCareSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childbirth_care_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->text('acceptance_condition')->nullable()->comment('受け入れ条件の説明文');
            $table->text('supported_service')->nullable()->comment('対応可能サービス');
            $table->timestamps();
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('childbirth_care_supports');
    }
}
