<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianProfileImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_profile_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_profiles_id')->comment('プロフィールID');
            $table->string('image_path')->comment('画像パス');
            $table->tinyInteger('which_image')->comment('写真の種類 (1:アイコン, 2:家族, 3:保育場所)');
            $table->tinyInteger('is_examination')->comment('審査フラグ');
            //$table->timestamps();
            $table->foreign('guardian_profiles_id')->references('id')->on('guardian_profiles')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian_profile_images');
    }
}
