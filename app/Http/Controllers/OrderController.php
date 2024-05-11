<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
}
