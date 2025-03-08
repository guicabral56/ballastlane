<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|min:3',
            'total_amount' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);

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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|min:3',
            'total_amount' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);

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
