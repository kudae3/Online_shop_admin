<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Product List
    public function productView(){
        $products = Product::select('products.*', 'categories.name as category_name')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->paginate(4);
        return view('Product.list', compact('products'));
    }
}
