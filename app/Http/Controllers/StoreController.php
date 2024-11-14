<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
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

        return StoreResource::collection($stores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Store $store)
    {
        $data = $request->validated();
        $store = Store::create($data);

        return new StoreResource($store);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return new StoreResource($store);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->validated());

        return new StoreResource($store);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json("Store deleted successfuly");
    }
}
