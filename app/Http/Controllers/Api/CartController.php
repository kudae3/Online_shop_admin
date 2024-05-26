<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Adding to Cart Btn
    public function addtoCart(Request $req){
        try {

            $data = [
                'user_id' => $req->user_id,
                'product_id' => $req->product_id,
                'quantity' => $req->count,
                'price' => $req->price
            ];

            Cart::create($data);

            return response()->json([
                'message' => 'successfully added to cart'
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'message' =>$e->getMessage()
            ], 500);

        }
    }

    //view Cart
    public function viewCart(Request $req){

        try {
            $cart = Cart::select('carts.*', 'products.name as product_name')
            ->leftJoin('products', 'carts.product_id', 'products.id')
            ->where('carts.user_id', $req->user_id)->get();

            return response()->json([
                'cart' => $cart
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }


    }

    //remove cart
    public function deleteCart(Request $req){
        try {

            Cart::where('id', $req->id)->delete();

            return response()->json([
                'message' => 'Success'
            ], 200);
        }
        catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
