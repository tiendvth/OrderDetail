<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use stdClass;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $quantity = 1;
        $id = $request->product_id;
        $product = Product::find($id);
        if ($product == null || $product->quantity < 1) {
            return response()->json([
                'code' => 404,
                'message' => 'product not found or quantity product < 1'
            ]);
        }
        if ($request->action) {
            if ($request->quantity > $product->quantity) {
                return response()->json([
                    'code' => 401,
                    'quantity_product' => $product->quantity,
                    'message' => 'product not found or quantity product < 1'
                ]);
            }
        }

        $shoppingCart = null;
        if (Session::has('shoppingCart')) {
            $shoppingCart = Session::get('shoppingCart');
        } else {
            $shoppingCart = [];
        }
        if (!array_key_exists($id, $shoppingCart)) {
            $cartItem = new stdClass();
            $cartItem->id = $product->id;
            $cartItem->product_name = $product->product_name;
            $cartItem->thumbnail = $product->thumbnail;
            $cartItem->price = $product->price;
            $cartItem->description = $product->description;
            $cartItem->quantity = $quantity;
        } else {
            $cartItem = $shoppingCart[$id];
            if ($request->action) {
                $quantity = $request->quantity;
                $cartItem->quantity = $quantity;
            } else {
                $cartItem->quantity += $quantity;
            }
        }
        $shoppingCart[$id] = $cartItem;
        Session::put('shoppingCart', $shoppingCart);
        return response()->json([
            'code' => 200,
            'message' => 'add to cart success !',
            'product_count' => sizeof(Session::get('shoppingCart')),
            'price' => $product->price
        ]);
    }

    public function show()
    {
        $product_count = 0;
        $list = [];
        if (Session::has('shoppingCart')) {
            $product_count = sizeof(Session::get('shoppingCart'));
            $list = array_reverse(Session::get('shoppingCart'));
        }

        return view('client.shopping_cart', ['list' => $list, 'product_count' => $product_count]);
    }


    public function remove(Request $request)
    {
        $id = $request->product_id;
        $shopping_cart = null;

        $shopping_cart = Session::get('shoppingCart');
        unset($shopping_cart[$id]);
        Session::put('shoppingCart', $shopping_cart);
        if (Session::has('shoppingCart')) {
            $product_count = sizeof(Session::get('shoppingCart'));
        }
        return response()->json([
            'code'=>200,
            'message'=>'delete product success',
            'product_count' => sizeof(Session::get('shoppingCart')),
        ]);
    }


}
