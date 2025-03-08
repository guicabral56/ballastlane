<?php

namespace App\Http\Controllers;

use App\Contracts\OrderSaleHandlerInterface;
use App\Http\Requests\OrderSaleRequest;

class OrderSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(app(OrderSaleHandlerInterface::class)->list());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderSaleRequest $request)
    {
        $request->validated();

        $orderSale = app(OrderSaleHandlerInterface::class)->create($request->customer_name, $request->user_id);
        return response()->json($orderSale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return app(OrderSaleHandlerInterface::class)->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderSaleRequest $request, $id)
    {
        $request->validated();

        $orderSale = app(OrderSaleHandlerInterface::class)->update($id, $request->customer_name, $request->user_id);
        return response()->json($orderSale, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        app(OrderSaleHandlerInterface::class)->delete($id);
        return response()->json(null, 204);
    }
}
