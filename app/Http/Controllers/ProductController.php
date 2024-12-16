<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Order;
use Carbon\Carbon;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::where('status',"1")->get();

        return view('shop.index',compact('items'));
    }

    public function detail($id)
    {
        $item = Item::find($id);
        return view('product.detail',compact('item'));
    }

    public function cart()
    {
        $carts = Cart::with('item')
        ->where('customer_id', session('customer_login_id'))
        ->get();
        return view('shop.cart',['cartItems'=>$carts]);
    }

    public function add(Request $request)
    {

        $alreadyInCart = Cart::where('customer_id', session('customer_login_id'))
            ->where('item_id', $request->product_id)
            ->first();

        if ($alreadyInCart) {
            return response()->json(['message' => 'Produk Sudah Ada di Keranjang!','alert'=>true], 200);
        }
    
        
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|exists:items,id', // Pastikan ID produk valid
            'quantity' => 'required|integer|min:1', // Harus bilangan bulat >= 1
        ]);
    
        // Buat data di keranjang
        Cart::create([
            'item_id' => $validated['product_id'], 
            'qty' => $validated['quantity'], 
            'customer_id' => session('customer_login_id') // Ambil dari session
        ]);
    
        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!'], 200);
    }

    public function reduceStockAndDeleteCart()
    {
        // Retrieve receipt number from the session
        $receiptNumber = session('receipt_number');
        
        if (!$receiptNumber) {
            return response()->json(['error' => 'Receipt number not found in session'], 400);
        }

        // Get order details using the receipt number
        $orderDetails = OrderDetail::where('receipt_number', $receiptNumber)->get();

        if ($orderDetails->isEmpty()) {
            return response()->json(['error' => 'No order details found for this receipt number'], 404);
        }

        // Loop through each order detail and reduce stock
        foreach ($orderDetails as $orderDetail) {
            $item = Item::find($orderDetail->item_id);

            if (!$item) {
                return response()->json(['error' => "Item with ID {$orderDetail->item_id} not found"], 404);
            }

            // Reduce stock by the order detail's quantity
            if ($item->stock < $orderDetail->qty) {
                return response()->json(['error' => "Not enough stock for item ID {$orderDetail->item_id}"], 400);
            }

            $item->stock -= $orderDetail->qty;
            $item->save();
            Cart::where('customer_id', session('customer_login_id'))->where('item_id',$orderDetail->item_id)->delete();
        }


        return redirect()->route('purchased');
    }

    public function purchased()
    {
        // $carts = Cart::with('item')
        // ->where('customer_id', session('customer_login_id'))
        // ->get();
        $purchased_item = Order::where('customer_id', session('customer_login_id'))
                            ->join('order_details', 'orders.receipt_number', '=', 'order_details.receipt_number')
                            ->join('items','order_details.item_id','=','items.id')
                            ->select('order_details.item_id', 'order_details.price', 'order_details.qty','items.name','items.image','order_details.created_at')
                            ->orderBy('order_details.created_at','DESC')
                            ->get()
                            ->map(function ($item) {
                                $item->formatted_date = Carbon::parse($item->created_at)->format('d M Y, H:i');
                                return $item;
                            });
        // return $purchased_item;

        return view('shop.purchased',['purchased_item'=>$purchased_item]);
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
        //
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
    public function destroy(string $product_id)
    {
        Cart::find($product_id)->delete();
        return redirect()->route('keranjang');
    }
}
