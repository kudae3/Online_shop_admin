<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Adding to Cart
    public function addtoCart(Request $req){
        try {

            $data = [
                'user_id' => $req->user_id,
                'product_id' => $req->product_id,
                'quantity' => $req->count,
                'price' => $req->price
            ];

            Cart::create($data);

        } catch (Exception $e) {

            return response()->json([
                'message' =>$e->getMessage()
            ], 500);

        }
    }
}
