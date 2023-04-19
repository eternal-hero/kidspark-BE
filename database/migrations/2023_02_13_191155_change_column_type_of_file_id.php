<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;


class ChangeColumnTypeOfFileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }

        Schema::table('supporter_application_documents', function (Blueprint $table) {
            $table->char('file_id', 6)->comment('ファイルのID')->change();
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
            $table->unsignedBigInteger('file_id')->comment('ファイルのID')->change();
        });
    }
}
