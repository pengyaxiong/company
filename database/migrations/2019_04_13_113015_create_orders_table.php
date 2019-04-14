<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id')->comment('微信用户ID');
            $table->tinyInteger('state')->default(1)->comment('订单状态');
            $table->string('express_id')->comment('物流ID');
            $table->string('express_code')->comment('物流编号');
            $table->decimal('express_money',10,2)->comment('物流费用');
            $table->tinyInteger('pay_type')->default(1)->comment('支付方式');
            $table->decimal('total_price',10,2)->comment('订单总价');
            $table->timestamp('pay_time')->comment('支付时间');
            $table->timestamp('picking_time')->comment('配货时间');
            $table->timestamp('shipping_time')->comment('发货时间');
            $table->timestamp('finish_time')->comment('完成时间');
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
        Schema::dropIfExists('orders');
    }
}
