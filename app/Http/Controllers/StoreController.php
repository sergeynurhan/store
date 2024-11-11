<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::with('products')->get();

        return response()->json($stores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Store $store)
    {
        $this->authorize('create', $store);

        $data = $request->validated();
        $store = Store::create($data);

        return response()->json($store);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $store = Store::find($id);

        return response()->json($store);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id, Store $store)
    {
        $store = Store::find($id);
        
        $this->authorize('update', $store);
        $store->update($request->validated());

        return response()->json($store);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        
        $this->authorize('delete', $store);
        $store->delete();

        return response()->json("Store deleted successfuly");
    }
}
