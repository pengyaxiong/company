<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id')->comment('微信用户ID');
            $table->text('province')->comment('省');
            $table->text('city')->comment('市');
            $table->text('area')->comment('区');
            $table->text('detail')->comment('详细地址');
            $table->string('tel')->comment('手机号');
            $table->string('name')->comment('姓名');
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
        Schema::dropIfExists('addresses');
    }
}
