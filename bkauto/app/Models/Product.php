<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type_id', 'price', 'describe', 'image'
    ];

    public static function getProduct()
    {
        $products = DB::table('products')
                    ->select('name', 'type_id', 'describe', 'price')
                    ->get()
                    ->toArray();

        return $products;
    }
}
