<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('aid')->nullable();

            $table->string('wechat_app_id')->nullable(); //微信公众号设置参数
            $table->string('wechat_secret')->nullable();
            $table->string('wechat_token')->nullable();
            $table->string('wechat_aes_key')->nullable();

            $table->string('pay_mch_id')->nullable();  //微信支付设置参数
            $table->string('pay_api_key')->nullable();
            $table->string('pay_cert_path')->nullable();
            $table->string('pay_key_path')->nullable();

            $table->string('op_app_id')->nullable();  //微信开放平台设置参数
            $table->string('op_secret')->nullable();
            $table->string('op_token')->nullable();
            $table->string('op_aes_key')->nullable();

            $table->string('work_corp_id')->nullable();  //微信企业号设置参数
            $table->string('work_agent_id')->nullable();
            $table->string('work_secret')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechats');
    }
}
