<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('名称');
            $table->string('code')->comment('编号');
            $table->text('url')->comment('链接');
            $table->decimal('shipping_money',10,2)->comment('运费');
            $table->decimal('shipping_free',10,2)->comment('满额包邮');
            $table->text('description')->comment('说明');
            $table->string('sort_order')->default(99)->comment('排序');
            $table->tinyInteger('is_enable')->default(0)->comment('可用');
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
        Schema::dropIfExists('expresses');
    }
}
