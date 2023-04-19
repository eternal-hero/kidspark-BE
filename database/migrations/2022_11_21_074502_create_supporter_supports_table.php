<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporterSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporter_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settings_id')->comment('設定識別ID');
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->tinyInteger('shooting_support')->comment('お子様の撮影対応用フラグ。撮影しない：0，撮影する：１');
            $table->text('acceptance_condition')->nullable()->comment('受け入れ条件の説明文');
            $table->tinyInteger('transportation_support')->comment('対応可能サービス、送迎サポート。対応しない：0，対応する：1');
            $table->integer('early_response_lower_limit')->nullable()->comment('対応可能サービス、早期対応の下限。0~24時まで');
            $table->integer('early_response_upper_limit')->nullable()->comment('対応可能サービス、早期対応の上限。0~24時まで');
            $table->integer('nighttime_lower_limit')->nullable()->comment('対応可能サービス、夜間対応の下限。0~24時まで');
            $table->integer('nighttime_upper_limit')->nullable()->comment('対応可能サービス、夜間対応の上限。0~24時まで');
            $table->integer('overnight_care_lower_limit')->nullable()->comment('対応可能サービス、お泊り保育の下限。0~24時まで');
            $table->integer('overnight_care_upper_limit')->nullable()->comment('対応可能サービス、お泊り保育の上限。0~24時まで');
            $table->tinyInteger('is_foreign_user_support')->comment('外国籍ユーザの対応フラグ。引き受けない：0，引き受ける：1');
            $table->tinyInteger('is_sick_children_support')->comment('病児対応のフラグ。引き受けない：0，引き受ける：1');
            $table->tinyInteger('is_handicapped_children_support')->comment('障がい児対応のフラグ。引き受けない：0，引き受ける：1');
            $table->unsignedTinyInteger('lesson_support_bitflag')->comment('レッスン対応のビットフラグ。0bit：英語レッスン，1bit：音楽レッスン，2bit：スポーツレッスン，3bit：絵、工作レッスン（0：チェックなし，1：チェックあり）');
            $table->tinyInteger('is_cabinet_office_discount_coupon')->comment('内閣府割引対象フラグ。対象外：0，対象者：1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supporter_supports');
    }
}
