<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;


class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $order_detail = OrderDetail::with('item')->where('receipt_number',session()->get('receipt_number'))->get();
        $order        = Order::with('customer')->where('receipt_number',session()->get('receipt_number'))->first();
        return $order;
        return view('shop.checkout',compact('order_detail','order'));
    }
}
