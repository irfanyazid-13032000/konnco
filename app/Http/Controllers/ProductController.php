<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Cart;
use App\Models\OrderDetail;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

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

    public function reduceStock()
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
    }

    return redirect()->route('shop.index');
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
