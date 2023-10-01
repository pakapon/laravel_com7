<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cache;

class UserProductController extends Controller
{
    // public function index()
    // {
    //     return Cache::remember('products', 60, function () {
    //         return Product::all();
    //     });
    // }
    public function index()
    {
        return ProductResource::collection(Product::all());
    }
}
