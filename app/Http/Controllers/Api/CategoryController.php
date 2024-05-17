<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Error;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //category list
    public function categoryList(){

        try {

            $categories = Category::get();

            return response()->json([
                'message' => 'success',
                'categories' => $categories
            ], 200);

        } catch (Exception $e) {

            return response()->json ([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

    }

    // filter by category
    public function filterCategory(Request $req){

        try {
            if ($req->id) {
                $products = Product::select('products.*', 'categories.name as category_name')
                            ->join('categories', 'products.category_id', 'categories.id')
                            ->where('products.category_id', $req->id)
                            ->get();

                return response()->json([
                    'products' => $products
                ], 200);

            } else {
                $products = Product::select('products.*', 'categories.name as category_name')
                            ->join('categories', 'products.category_id', 'categories.id')
                            ->get();

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

}
