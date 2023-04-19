<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporter_profile_images', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_profiles', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_settings', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('pre_interview_settings', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_application_details', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_application_histories', function (Blueprint $table) {
            $table->foreign('application_id')->references('id')->on('supporter_application_details');
        });
        Schema::table('supporter_application_documents', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('beneficiary_accounts', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_notices', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_works_images', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_experience', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_options', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('support_area', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_settings', function (Blueprint $table) {
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
        });
        Schema::table('supporter_options', function (Blueprint $table) {
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
        });
        Schema::table('supporter_supports', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('supporter_supports', function (Blueprint $table) {
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
        });
        Schema::table('housekeeping_settings', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('housekeeping_settings', function (Blueprint $table) {
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
        });
        Schema::table('housekeeping_supports', function (Blueprint $table) {
            $table->foreign('settings_id')->references('id')->on('supporter_settings_managements');
        });
        Schema::table('housekeeping_supports', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('deposit_withdrawal_histories', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
        Schema::table('result_summaries', function (Blueprint $table) {
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // table_key_foreign
        Schema::table('supporter_profile_images', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_profiles', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_settings', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('pre_interview_settings', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_application_details', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_application_histories', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
        });
        Schema::table('supporter_application_documents', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('beneficiary_accounts', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_notices', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_works_images', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_experience', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_options', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('support_area', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_settings', function (Blueprint $table) {
            $table->dropForeign(['settings_id']);
        });
        Schema::table('supporter_options', function (Blueprint $table) {
            $table->dropForeign(['settings_id']);
        });
        Schema::table('supporter_supports', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('supporter_supports', function (Blueprint $table) {
            $table->dropForeign(['settings_id']);
        });
        Schema::table('housekeeping_settings', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
            $table->dropForeign(['settings_id']);
        });
        Schema::table('housekeeping_supports', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
            $table->dropForeign(['settings_id']);

        });
        Schema::table('deposit_withdrawal_histories', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('result_summaries', function (Blueprint $table) {
            $table->dropForeign(['supporter_user_id']);
        });
    }
}
