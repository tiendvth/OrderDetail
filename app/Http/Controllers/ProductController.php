<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_details;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(){
        $products = Product::query()->orderBy('created_at','ASC')->paginate(15);
        $product_count = 0;
        if (Session::has('shoppingCart')){
            $product_count = sizeof(Session::get('shoppingCart'));
        }



        return view('client.shop',['products'=>$products,'product_count'=>$product_count]);
    }
    public function save(Request $request){
        //shopingcart(cartIteml,cartitem2)
        //kiemr tra thông tin giá hàng, nếu không có san phẩm từ trả veef trang product
        if (!Session::has('shopingCart')|| count(Session::get('shopingCart'))==0){
            Session::flash('error-asg','Hiện tại không có sản phẩm nào trong giỏ');
            return redirect('/product');
        }
        //chuyển đổi từ shopping cart sang oddderr, từng cartItem sẽ chuyển thành order detals
        $shoppingcart = Session::get('shoppingcart');
        $order = new Order();
        $order -> totalPice = 0;
        $order -> custome  = 1;
        $order -> shipName = $request->get('fullName');
        $order -> shipPhone = $request->get('phone');
        $order -> shipAddress = $request->get('address');
        $order -> note = $request->get('note');
        $order -> ischeckout = false;// defuaut là chưa thanh toán
        $order -> create_at = Carbon::now();
        $order -> update_at = Carbon::now();
        $order -> status = 0;
        $orderDetails = [];
        $nessageErro = '';
        foreach ($shoppingcart as $cartItem){
            $product =Product::find($cartItem->id);
            if ($product == null){
                $nessageErro = ' có lỗi xảy ra, sản phẩm với id'. $cartItem->id. 'không tồn tại hoặc đã bị xóa';
                break;
            }
            $orderDetails = new Order_details();// hiện tại chưa có order vì chưa đc lưu, cho nên kgoong set orderID tại thông tin
            $orderDetails ->productId = $product->id;
            $orderDetails ->unitPice = $product->pice;
            $orderDetails ->quantity = $cartItem->pice;
            $order->totalPice += $orderDetails->quantity = $orderDetails->unitPice;

        }
        if (count($orderDetails)==0){
            Session::flash('error-asg',$nessageErro);
            return redirect('/product');

            try {
                DB::beginTransaction();
                //database queries here
                $order->save();// order sau dòng cade này có id
                $orderDetailsAray = [];
                foreach ($orderDetails as $orderDetail){
                    $orderDetails->orderId = $order->id;
                    array_push($orderDetailsAray,$orderDetails->toArray());
                }
                $orderDetails::insert($orderDetailsAray);
                DB::commit();//fissh transaction, tắt được update database.
                Session::forget('shoppingcart');
                Session::flash('success-msg','lưu đơn hàng thất bại');
            }catch (\Exception $e){
                DB::rollBack();
                Session::flash('success-msg','lưu đơn hàng thất bại');
            }
            return redirect('/product');
        }



    }
}
