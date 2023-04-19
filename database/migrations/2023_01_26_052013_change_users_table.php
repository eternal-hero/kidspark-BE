<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_users', function (Blueprint $table) {
            $table->text('memo')->comment('メモ');
        });
        Schema::table('guardian_users', function (Blueprint $table) {
            $table->text('memo')->comment('メモ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporter_users', function (Blueprint $table) {
            $table->dropColumn('memo');
        });
        Schema::table('guardian_users', function (Blueprint $table) {
            $table->dropColumn('memo');
        });
    }
}
