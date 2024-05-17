<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //product list
    public function productList(){
        try {

            $products = Product::get();

            return response()->json([
                'products' => $products
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }

    //product searching
    public function searchProduct(Request $req){
        try {

            if($req->search){
                $products = Product::where('name', 'like', '%'.$req->search.'%')
                                    ->orWhere('description', 'like', '%'.$req->search.'%')
                                    ->get();

                return response()->json([
                    'products' => $products
                ], 200);
            }

            else{
                $products = Product::get();

                return response()->json([
                    'products' => $products
                ], 200);
            }

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //product Detail
    public function productDetail(Request $req){

        try {

            $product = Product::select('products.*', 'categories.name as category_name')
                        ->join('categories', 'products.category_id', 'categories.id')
                        ->where('products.id', $req->id)->first();

            return response()->json([
                'product' => $product
            ], 200);


        } catch (Exception $e) {

            return response()->json([
                'message' =>$e->getMessage()
            ], 500);

        }

    }
}
