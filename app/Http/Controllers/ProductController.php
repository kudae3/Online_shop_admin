<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    // create Product View
    public function createProduct(){

        $categories = Category::get();

        return view('Product.create', compact('categories'));
    }

    //create Btn
    public function createBtn(Request $req){
        $this->validationRule($req);
        $newProduct = $this->getData($req);

        $imageName = uniqid().'_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public', $imageName);
        $newProduct['photo'] = $imageName;

        Product::create($newProduct);
        return redirect()->route('product#list');
    }

    //delete Btn
    public function deleteProduct($id){

        //delete photo in Storage
        $product = Product::where('id', $id)->first();
        $image = $product->photo;
        Storage::delete('public/'.$image);

        Product::where('id', $id)->delete();
        return redirect()->route('product#list');
    }

    //Validation
    private function validationRule($req){
        Validator::make($req->all(), [
            'image' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required|unique:products,name,'.$req->id,
            'price' => 'required|numeric',
            'description' => 'required|max:200',
        ] )->validate();
    }

    //get Data
    private function getData($req){
        return [
            'name' => $req->name,
            'description' => $req->description,
            'price' => $req->price,
            'category_id' => $req->category
        ];
    }


}
