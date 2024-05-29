<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // adding order
    public function addOrder(Request $req){

        try {

            $order_code = mt_rand(0, 100000000000);


            Order::create([
                'user_id' => $req->user_id,
                'order_code' => 'Shauzk_'.$order_code,
                'total_price' => $req->subtotal,
                'status' => '0'
            ]);

            $orders = Cart::where('user_id', $req->user_id)->get();

            foreach ($orders as $order) {

                OrderList::create([
                    'user_id' => $req->user_id,
                    'product_id' => $order->product_id,
                    'price' => $order->price,
                    'quantity' => $order->quantity,
                    'total_price' => $order->price * $order->quantity,
                    'order_code' => 'Shauzk_'.$order_code
                ]);

                Cart::where('id', $order->id)->delete(); //remove from cart
            }

            return response()->json([
                'message' => 'Successfully ordered'
            ], 200);


        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

    }

    // order list
    public function orderList(Request $req){

        try {
            $orders = Order::where('user_id', $req->user_id)->get();

            return response()->json([
                'orders' => $orders
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }

    }
}
