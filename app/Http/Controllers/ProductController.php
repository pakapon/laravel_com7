<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('edit-products')) {
            abort(403, 'Unauthorized action.');
        }
    
        $product = Product::create($request->all());
        return new ProductResource($product);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (Gate::denies('edit-products')) {
            abort(403, 'Unauthorized action.');
        }
    
        // ปรับปรุงข้อมูลสินค้า
        $product->update($request->all());
    
        // ส่งค่ากลับหลังจากการปรับปรุง
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Gate::denies('delete-products')) {
            abort(403, 'Unauthorized action.');
        }
    }
}
