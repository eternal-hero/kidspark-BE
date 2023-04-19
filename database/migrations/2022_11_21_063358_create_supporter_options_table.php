<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->integer('additional_subject')->comment('追加する対象の項目。settings_idによって意味が変わる。');
            $table->text('option_content')->comment('オプション内容');
            $table->integer('additional_fee')->comment('追加料金。');
            $table->integer('unit')->comment('単位。「円/時間」-0，「円/1回あたり」-1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_options');
    }
}
