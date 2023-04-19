<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuardiansTimestamps extends Migration
{
    private $target_tables = [
        'guardian_users',
        'children',
        'guardian_profiles',
        'guardian_profile_images',
        'identity_verification',
        'guardian_notice',
        'application_forms',
        'points',
        'publish_applications',
        'identity_verification_files'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //既存の"updated_atを削除"
        Schema::table('application_forms', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });

        //timestamps追加
        foreach($this->target_tables as $target){
            Schema::table($target, function (Blueprint $table) {
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //timestampsを削除
        foreach($this->target_tables as $target){
            Schema::table($target, function (Blueprint $table) {
                $table->dropColumn('created_at');
                $table->dropColumn('updated_at');
            });
        }
        //"updated_atを追加"
        Schema::table('application_forms', function (Blueprint $table) {
            $table->date('updated_at')->comment('最終更新日時');
        });
    }
}
