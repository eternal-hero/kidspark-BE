<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnApplicationTypeIntoSupporterApplicationDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_application_documents', function (Blueprint $table) {
            $table->integer('application_type')->after('category')->comment('本人確認・資格証書の名称。');
            $table->text('application_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporter_application_documents', function (Blueprint $table) {
            $table->dropColumn('application_type');
            $table->integer('application_name')->nullable(false)->change();
        });
    }
}
