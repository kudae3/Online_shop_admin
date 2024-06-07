<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order view
    public function orderView(Request $req){

        // filter and searching
        if($req->status == null){
            $orders = Order::select('orders.*','users.name as user_name')

            ->when(request('search'), function($query){
                $query  ->orWhere('users.name', 'like', '%' . request('search') . '%')
                        ->orWhere('orders.user_id', request('search'))
                        ->orWhere('orders.order_code', 'like', '%' . request('search') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->paginate('5');
        }
        else{

            $orders = Order::select('orders.*','users.name as user_name')

            ->when(request('search'), function($query){
                $query  ->orWhere('users.name', 'like', '%' . request('search') . '%')
                        ->orWhere('orders.user_id', request('search'))
                        ->orWhere('orders.order_code', 'like', '%' . request('search') . '%');
            })
            ->where('status', $req->status)
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc')
            ->paginate('5');
        }

        return view('Order.list', compact('orders'));
    }

    //change Status
    public function changeStatus(Request $req){
        Order::where('id', $req->id)->update([
            'status' => $req->status
        ]);
        return redirect()->back();
    }

    //order detail
    public function orderDetail(Request $req){

        $orders = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name')
                ->join('users', 'order_lists.user_id', 'users.id')
                ->join('products', 'order_lists.product_id', 'products.id')
                ->where('order_code', $req->code)
                ->get();
        return view('Order.detail', compact('orders'));
    }
}
