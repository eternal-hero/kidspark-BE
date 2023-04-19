<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInoculationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inoculation_status', function (Blueprint $table) {
            $table->id();
            $table->integer('inoculation_times')->comment('接種回数');
            $table->date('inoculation_on')->comment('最新接種日付');
            $table->tinyInteger('is_publish')->comment('公開');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inoculation_status');
    }
}
