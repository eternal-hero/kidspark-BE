<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePreInterviewSettingsColumnsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_interview_settings', function (Blueprint $table) {
            $table->integer('web_meeting_fee')->nullable(true)->change();
            $table->integer('facetoface_meeting_fee')->nullable(true)->change();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pre_interview_settings', function (Blueprint $table) {
            $table->integer('web_meeting_fee')->nullable(false)->change();
            $table->integer('facetoface_meeting_fee')->nullable(false)->change();
        });
    }
}
