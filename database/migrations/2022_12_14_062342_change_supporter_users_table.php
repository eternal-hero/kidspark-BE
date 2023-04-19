<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSupporterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_users', function (Blueprint $table) {
            $table->string('name')->comment('名前')->change();
            $table->string('kana')->comment('名前 ふりがな')->change();
        });

        Schema::table('supporter_users', function (Blueprint $table) {
            $table->string('last_name')->comment('姓')->after('name');
            $table->string('last_kana')->comment('姓 ふりがな')->after('kana');
            $table->renameColumn('name','first_name');
            $table->renameColumn('kana','first_kana');
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
            $table->string('first_name')->comment('名前')->change();
            $table->string('first_kana')->comment('ふりがな')->change();
        });

        Schema::table('supporter_users', function (Blueprint $table) {
            $table->renameColumn('first_name','name');
            $table->renameColumn('first_kana','kana');
            $table->dropColumn('last_name');
            $table->dropColumn('last_kana');
        });
    }
}
