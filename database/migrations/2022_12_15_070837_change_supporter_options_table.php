<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSupporterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_options', function (Blueprint $table) {
            $table->renameColumn('additional_subject', 'subject_type');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporter_options', function (Blueprint $table) {
            $table->renameColumn('subject_type', 'additional_subject');
        });
    }
}
