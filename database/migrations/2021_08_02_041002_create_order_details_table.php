<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('orderId');// thuộc dơn hàng nào?
            $table->foreign('orderId')->references('id')->on('oders');
            $table->unsignedBigInteger('productId');// mua cái gì
            $table->foreign('productId')->references('id')->on('products');
            $table->double('uniPice');//giá một sản phẩm là bao nhiêu
            //trang một đơn hàng, sẽ khồn xó các sản phẩm id trung nhau
            //mà chr thay đổi số lượng thôi.
            $table->primary(['orderId','productId']); // thuộc đơn hàng nào, sản phẩm là gì
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
        Schema::dropIfExists('order_details');
    }
}
