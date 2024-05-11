<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //fav list
    public function favView(){
        $favs = Favourite::select('favourites.*', 'users.name as user_name', 'products.name as product_name')

                ->when(request('search'), function($query){
                    $query  ->orWhere('users.name', 'like', '%'.request('search').'%')
                            ->orWhere('products.name', 'like', '%'.request('search').'%');
                })

                ->leftJoin('users', 'favourites.user_id', 'users.id')
                ->leftJoin('products', 'favourites.product_id', 'products.id')
                ->orderBy('created_at', 'desc')
                ->paginate('5');

        return view('Favourite.list', compact('favs'));
    }
}
