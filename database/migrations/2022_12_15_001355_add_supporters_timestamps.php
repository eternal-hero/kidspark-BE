<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupportersTimestamps extends Migration
{
    private $delete_target = [
        'supporter_works_images',
        'supporter_application_details',
        'supporter_application_histories'
    ];
    private $add_target = [
        'supporter_users',
        'supporter_profile_images',
        'supporter_profiles',
        'inoculation_status',
        'support_area',
        'pre_interview_settings',
        'supporter_settings_managements',
        'supporter_settings',
        'supporter_options',
        'supporter_supports',
        'supporter_experience',
        'housekeeping_settings',
        'housekeeping_supports',
        'supporter_works_images',
        'result_summaries',
        'result_reviews',
        'result_sales',
        'deposit_withdrawal_histories',
        'job_reservations',
        'beneficiary_accounts',
        'supporter_notices',
        'supporter_application_documents',
        'supporter_application_details',
        'supporter_application_histories',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //既存の"update_atを削除"
        foreach($this->delete_target as $target){
            Schema::table($target, function (Blueprint $table) {
                $table->dropColumn('update_at');
            });
        }

        //timestamps追加
        foreach($this->add_target as $target){
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
        foreach($this->add_target as $target){
            Schema::table($target, function (Blueprint $table) {
                $table->dropColumn('created_at');
                $table->dropColumn('updated_at');
            });
        }
        //"update_atを追加"
        foreach($this->delete_target as $target){
            Schema::table($target, function (Blueprint $table) {
                $table->date('update_at')->comment('最終更新日時');
            });
        }
    }
}
