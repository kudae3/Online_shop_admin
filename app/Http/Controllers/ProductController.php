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
        $this->productValidation($req, 'create');
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

    //edit Page View
    public function editProduct($id){
        $product = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('Product.edit', compact('product', 'categories'));

    }

    //update Btn
    public function updateBtn(Request $req, $id){
        $this->productValidation($req, 'update');
        $updateProduct = $this->getData($req);

        if($req->hasFile('image')){

            //delete
            $currnetProduct = Product::where('id', $id)->first();
            $currentImage = $currnetProduct->photo;
            Storage::delete('public/'.$currentImage);

            //update
            $imageName = uniqid().'_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public', $imageName);
            $updateProduct['photo'] = $imageName;
        }

        Product::where('id', $id)->update($updateProduct);
        return redirect()->route('product#list');

    }

    //view detail
    public function viewProduct($id){
        $product = Product::select('products.*', 'categories.name as category_name')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->where('products.id', $id)->first();

        return view('Product.detail', compact('product'));
    }

    //Validation
    private function productValidation($req, $action){

        $validationRules = [
            'image' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required|unique:products,name,'.$req->id,
            'price' => 'required|numeric',
            'description' => 'required|max:200',
        ];

        if($action == 'create'){
            $validationRules['image'] = 'required|mimes:png,jpg,jpeg';
        }
        else{
            $validationRules['image'] = 'mimes:png,jpg,jpeg';
        }



        Validator::make($req->all(), $validationRules )->validate();
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
