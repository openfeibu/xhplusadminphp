<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops',function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id')->unsigned() ;
            $table->string('shops_name',120)->unique()->comment('店名');
			$table->string('shops_img');
            $table->string('description');
            $table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
		});
		Schema::create('goods',function(Blueprint $table){
			$table->increments('id');
			$table->integer('shop_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('goods_name',120);
			$table->string('goods_sn',60);
			$table->decimal('goods_price',10,2)->unsigned();
			$table->integer('click_count')->unsigned()->comment('浏览量');
			$table->integer('sale_count')->unsigned()->comment('销量');
			$table->smallInteger('goods_number')->unsigned()->comment('库存');
			$table->text('goods_desc')->comment('商品描述');
			$table->string('goods_img')->comment('商品图片');
			$table->tinyInteger('is_on_sale')->unsigned()->comment('在售');
			$table->foreign('shop_id')->references('id')->on('shops')
                ->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
			$table->timestamps();
			$table->index('goods_name');
			$table->index('goods_sn');
		});
		Schema::create('carts',function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('goods_id')->unsigned();			
			$table->string('goods_sn',60);
			$table->decimal('goods_price',10,2)->unsigned();
			$table->smallInteger('goods_number')->unsigned();
			$table->timestamps();
			$table->index('user_id');
			$table->index('goods_sn');
		});
		Schema::create('order_info',function(Blueprint $table){
			$table->increments('id');
			$table->string('order_sn')->unique();
			$table->integer('user_id')->unsigned();
			$table->tinyInteger('order_status')->unsigned();
			$table->tinyInteger('pay_status')->unsigned();
			$table->string('consignee',60)->comment('收货姓名');
			$table->string('address')->comment('收货地址');
			$table->string('mobile',60);
			$table->string('email',60);
			$table->string('postscript')->comment('留言');
			$table->tinyInteger('pay_id')->unsigned()->comment('支付方式id');
			$table->string('pay_name',60)->comment('支付名称');
			$table->timestamp('pay_time')->comment('支付时间');
			$table->decimal('goods_amount',10,2)->comment('商品总金额');
			$table->decimal('shipping_fee',10,2)->comment('任务费用');
			$table->decimal('insure_fee',10,2)->comment('保价费用');
			$table->string('to_buyer')->comment('商家给买家留言');
			$table->timestamps();		
			$table->index('user_id');
			$table->index('order_status');
			$table->index('pay_status');
			$table->index('pay_id');
			
		});
		Schema::create('order_goods',function(Blueprint $table){
			$table->increments('id');
			$table->integer('order_id')->unsigned();
			$table->integer('goods_id')->unsigned();
			$table->string('goods_sn',60);
			$table->string('goods_name',60);
			$table->string('goods_desc');
			$table->integer('goods_number')->unsigned();		
			$table->decimal('goods_price',10,2);
			$table->foreign('order_id')->references('id')->on('order_info')
                ->onUpdate('cascade')->onDelete('cascade');
			$table->index('order_id');
			$table->index('goods_id');
			
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
		Schema::dropIfExists('goods');
		Schema::dropIfExists('carts');
		Schema::dropIfExists('order_info');
		Schema::dropIfExists('order_goods');
    }
}
