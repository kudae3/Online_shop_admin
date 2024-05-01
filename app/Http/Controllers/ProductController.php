<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Product List
    public function productView()
    {
        $products = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(4);

        $categories = Category::get();
        return view('Product.list', compact('products', 'categories'));
    }

    //Product Search
    public function productSearch()
    {
        $products = Product::select('products.*', 'categories.name as category_name')

            ->when(request('search'), function ($query) {
                $query->where('products.name', 'like', '%' . request('search') . '%');
            })

            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(4);

        $categories = Category::get();
        return view('Product.list', compact('products', 'categories'));
    }

    //product filter
    public function productFilter(Request $req)
    {

        $products = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('created_at', 'desc');

        if ($req->category_id == null) {
            $products = $products->paginate(4);
        } else {
            $products = $products->where('categories.id', $req->category_id)->paginate(4);
        }


        $categories = Category::get();
        return view('Product.list', compact('products', 'categories'));
    }
}
