<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $products = Product::where('store_id', $id)->get();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, $id, Product $product)
    {
        $this->authorize('create', $product);

        $store = Store::find($id);
        $data = $request->validated();
        
        $product = $store->products()->create($data);

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $this->authorize('update', $product);

        if (auth()->user()->id === $product->store->manager_id)
        {
            $data = $request->validated();
            $product->update($data);
    
            return response()->json($product);
        }

        return response()->json("Current manager cannot update another manager's product");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if (auth()->user()->id === $product->store->manager_id)
        {
            $product->delete();
            return response()->json("Product deleted successfuly");
        }

        return response()->json("Current manager cannot delete another manager's product");
    }
}
