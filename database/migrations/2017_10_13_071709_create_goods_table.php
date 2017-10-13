<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');   //栏目id
            $table->integer('type_id');  //类型id
            $table->integer('deliver_id');  //发货Id
            $table->string('name',100);  //商品名称
            $table->string('sn',50); //sn
            $table->string('image_url',200);  //图片
            $table->integer('price');  //价格
            $table->integer('stock'); //库存
            $table->integer('sales');  //销售量
            $table->text('description'); //描述
            $table->text('content'); //内容
            $table->integer('top'); //推荐
            $table->integer('hot'); //火爆
            $table->integer('sort'); //排序
            $table->integer('status'); //状态

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
        Schema::dropIfExists('goods');
    }
}
