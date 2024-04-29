<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryView(){

        $categories = Category::when( request('search'), function($query){

            $query  ->orWhere('id',request('search'))
                    ->orWhere('name','like','%'.request('search').'%')
                    ->orWhere('description','like','%'.request('search').'%');

        })->paginate(3);

        return view('Category.list', compact('categories'));
    }

    //create Category
    public function createCategory(){
        return view('Category.create');
    }
}
