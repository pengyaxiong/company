<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_id')->comment('品牌ID');
            $table->string('photo_id')->comment('图片ID');
            $table->string('name')->comment('商品名称');
            $table->decimal('price',10,2)->comment('单价');
            $table->tinyInteger('is_top')->default(0)->comment('置顶');
            $table->tinyInteger('is_recommend')->default(0)->comment('推荐');
            $table->tinyInteger('is_hot')->default(0)->comment('热销');
            $table->tinyInteger('is_new')->default(1)->comment('新品');
            $table->tinyInteger('is_onsale')->default(1)->comment('上架');
            $table->tinyInteger('stock')->default(-1)->comment('库存');
            $table->string('sort_order')->default(99)->comment('排序');
            $table->text('description')->comment('介绍');
            $table->text('content')->comment('详情');
            $table->text('markdown_html_code')->comment('HTML详情');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
