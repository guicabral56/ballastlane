<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderSaleRequest;
use App\Models\OrderSale;
use Illuminate\Http\Request;

class OrderSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderSale::all();
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderSaleRequest $request)
    {
        $request->validated();

        $orderSale = OrderSale::create($request->all());
        return response()->json($orderSale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return OrderSale::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderSaleRequest $request, $id)
    {
        $request->validated();

        $orderSale = OrderSale::findOrFail($id);
        $orderSale->update($request->all());
        return response()->json($orderSale, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        OrderSale::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
