<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categoryView(){

        $categories = Category::when( request('search'), function($query){

            $query  ->orWhere('id',request('search'))
                    ->orWhere('name','like','%'.request('search').'%')
                    ->orWhere('description','like','%'.request('search').'%');

        })->orderBy('created_at', 'desc')->paginate(3);

        return view('Category.list', compact('categories'));
    }

    //create Category View
    public function createCategory(){
        return view('Category.create');
    }

    //create Category
    public function createBtn(Request $req){

        $this->validationRule($req);
        $newCategory = $this->getData($req);
        Category::create($newCategory);
        return redirect()->route('category#list');
    }

    //delete Category
    public function deleteCategory($id){
        Category::where('id', $id)->delete();
        return redirect()->route('category#list');
    }

    //validation
    private function validationRule($req){

        Validator::make($req->all(), [
            'name' => 'required|unique:categories,name,except,id',
            'description' => 'required|max:200',
        ])->validate();

    }

    //get Data
    private function getData($req){
        return [
            'name' => $req->name,
            'description' => $req->description
        ];
    }
}
