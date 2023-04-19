<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSupporterSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_supports', function (Blueprint $table) {
            $table->tinyInteger('is_handicapped_children_approval')->after('is_handicapped_children_support')->default(0)->comment('障がい児対応 0:引受不可,1:引受可能');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporter_supports', function (Blueprint $table) {
            $table->dropColumn('is_handicapped_children_approval');
        });
    }
}
