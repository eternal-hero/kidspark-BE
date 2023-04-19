<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForignKeyJobsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('guardian_user_id')->references('id')->on('guardian_users')->onUpdate('CASCADE');
            $table->foreign('supporter_user_id')->references('id')->on('supporter_users')->onUpdate('CASCADE');
        });
        Schema::table('job_requests', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
            $table->foreign('estimated_amounts_id')->references('id')->on('estimated_amounts')->onUpdate('CASCADE');
        });
        Schema::table('reserve_options', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
            $table->foreign('option_id')->references('id')->on('supporter_options')->onUpdate('CASCADE');
        });
        Schema::table('reserve_children', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
            $table->foreign('child_id')->references('id')->on('children')->onUpdate('CASCADE');
        });
        Schema::table('job_monitarings', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
        });
        Schema::table('job_cancels', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
        });
        Schema::table('pre_quotations', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
        });
        Schema::table('quotation_fee_items', function (Blueprint $table) {
            $table->foreign('quotation_id')->references('id')->on('pre_quotations')->onUpdate('CASCADE');
        });
        Schema::table('completion_reports', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
        });
        Schema::table('report_fee_items', function (Blueprint $table) {
            $table->foreign('report_id')->references('id')->on('completion_reports')->onUpdate('CASCADE');
        });
        Schema::table('job_support_records', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
        });
        Schema::table('job_reservation_summaries', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE');
            $table->foreign('monitaring_id')->references('id')->on('job_monitarings')->onUpdate('CASCADE');
        });
        Schema::table('report_contents', function (Blueprint $table) {
            $table->foreign('report_id')->references('id')->on('completion_reports')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //*/
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['guardian_user_id']);
            $table->dropForeign(['supporter_user_id']);
        });
        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropForeign(['estimated_amounts_id']);
        });
        Schema::table('reserve_options', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropForeign(['option_id']);
        });
        Schema::table('reserve_children', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropForeign(['child_id']);
        });
        Schema::table('job_monitarings', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        Schema::table('job_cancels', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        Schema::table('pre_quotations', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        Schema::table('quotation_fee_items', function (Blueprint $table) {
            $table->dropForeign(['quotation_id']);
        });
        Schema::table('completion_reports', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        Schema::table('report_fee_items', function (Blueprint $table) {
            $table->dropForeign(['report_id']);
        });
        Schema::table('job_support_records', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        Schema::table('job_reservation_summaries', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropForeign(['monitaring_id']);
        });
        Schema::table('report_contents', function (Blueprint $table) {
            $table->dropForeign(['report_id']);
        });
        //*/
    }
}
