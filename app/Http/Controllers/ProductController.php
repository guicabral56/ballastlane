<?php

namespace App\Http\Controllers;

use App\Contracts\ProductHandlerInterface;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(app(ProductHandlerInterface::class)->list(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validated();

        $product = app(ProductHandlerInterface::class)->create(
            $request->name,
            $request->price,
            $request->user_id,
            $request->order_sale_id
        );
        
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return app(ProductHandlerInterface::class)->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $request->validated();

        $product = app(ProductHandlerInterface::class)->update(
            $id,
            $request->name,
            $request->price,
        );
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        app(ProductHandlerInterface::class)->delete($id);
        return response()->json(null, 204);
    }
}
