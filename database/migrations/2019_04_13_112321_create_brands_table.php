<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo_id');
            $table->string('name', 225)->comment('标题');
            $table->string('url', 225)->comment('链接');
            $table->text('description')->comment('内容');
            $table->string('sort_order')->comment('排序');
            $table->tinyInteger('is_show')->default(0)->comment('显示');
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
        Schema::dropIfExists('brands');
    }
}
