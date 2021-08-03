<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');//mã đơn hàng
            $table->integer('customeId');//ai mua
            $table->double('totalPice');//mua tất cả hết bao nhiêu tiên
            $table->string('shipName'); //ship cho ai?
            $table->string('shipPhone'); //số phon gọi khi khẩn cấp
            $table->string('shipAddress'); // về đâu?
            $table->boolean('note'); // có lưu ý gì không
            $table->boolean('isCheckout'); // thanh toán hay chưa?
            $table->timestamp(); // create_at tạo ngày nào? update_at: thay đổi lần cuối khi nao
            //trang thái có thể có nhiều tùy thuộc vào độ phức tạp của bài toán.
            //1 - delected/ đã xóa
            //-2. cancel. hủy.
            //0.warring chờ phản hồi
            // 1. confirmed. Đã xác nhận đơn hàng.
            // 2. shipping. đang được vận chuyển
            // 3. Done. đã sử lý xong
            $table->integer('status');// trang thái là gì?; wairing, confirm, done
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
