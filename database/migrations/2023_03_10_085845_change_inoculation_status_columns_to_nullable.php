<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeInoculationStatusColumnsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inoculation_status', function (Blueprint $table) {
            $table->integer('inoculation_times')->nullable(true)->change();
            $table->date('inoculation_on')->nullable(true)->change();

            DB::statement('alter table inoculation_status modify column is_publish tinyint null');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inoculation_status', function (Blueprint $table) {
            $table->integer('inoculation_times')->nullable(false)->change();
            $table->date('inoculation_on')->nullable(false)->change();
        
            DB::statement('alter table inoculation_status modify column is_publish tinyint not null');
        });
    }
}
