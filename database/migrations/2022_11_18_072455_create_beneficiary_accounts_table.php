<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiaryAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supporter_user_id')->comment('パークサポーターID');
            $table->string('bank_name')->comment('銀行名　※要暗号化');
            $table->string('branch_name')->comment('支店名/支店番号　※要暗号化');
            $table->tinyInteger('account_type')->comment('口座の種類。普通預金：0，当座預金：1');
            $table->string('account_number')->comment('口座番号。「0xxxx」を許容するため文字列で　※要暗号化');
            $table->string('account_name')->comment('口座名義。　※要暗号化');
            $table->date('registration_on')->comment('登録日。');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_accounts');
    }
}
