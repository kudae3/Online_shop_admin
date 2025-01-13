<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\search;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'photo', 'description', 'price', 'view'
    ];

    public function scopeSearch($query, $search){
        $query->when($search??false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });
    }
}
