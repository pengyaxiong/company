<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->comment('微信ID');
            $table->tinyInteger('sex')->comment('微信性别');
            $table->string('language', 225)->comment('语言');
            $table->string('nickname', 225)->comment('微信昵称');
            $table->string('headimgurl', 225)->comment('微信头像');
            $table->string('tel')->comment('手机号');
            $table->text('country')->comment('国家');
            $table->text('province')->comment('省');
            $table->text('city')->comment('市');
            $table->string('address_id')->comment('地址ID');
            $table->string('email')->comment('邮箱');
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
        Schema::dropIfExists('customers');
    }
}
