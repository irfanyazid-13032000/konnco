<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Item;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        // return response()->json($request);
        $total_order = 0;
        $receipt_number = Str::random(40);
        
        foreach ($request->checkout_products as $checkout_product) {
            
            $product_data = Item::find($checkout_product['product_id']);
            $total_order += $product_data->price * $checkout_product['qty'];

            OrderDetail::create([
                'receipt_number'          => $receipt_number,
                'qty'                     => $checkout_product['qty'],
                'item_id'                 => $checkout_product['product_id'],
                'price'                   => $product_data->price,
                'total_price_per_item' => $product_data->price * $checkout_product['qty']
            ]);
            
        }

        Order::create([
            'total_order'    => $total_order,
            'customer_id'    => session('customer_login_id'),
            'receipt_number' => $receipt_number,
        ]);

        return response()->json([
            'message' => 'Order berhasil',
            'status' => 200
        ]);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
