<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $products = Product::where('store_id', $id)->get();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Store $store, Product $product)
    {
        $data = $request->validated();
        $product = $store->products()->create($data);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        if (auth()->user()->id === $product->store->manager_id)
        {
            $data = $request->validated();
            $product->update($data);
    
            return new ProductResource($product);
        }

        return response()->json("Current manager cannot update another manager's product");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (auth()->user()->id === $product->store->manager_id)
        {
            $product->delete();
            return response()->json("Product deleted successfuly");
        }

        return response()->json("Current manager cannot delete another manager's product");
    }
}
