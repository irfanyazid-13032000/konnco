@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
<div class="cart-container">
    <h1>Keranjang Belanja</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th><input class="large-checkbox" type="checkbox" id="select-all" onclick="toggleAll(this)"></th>
                <th width="25%" style="text-align:center;">Product</th>
                <th width="25%" style="text-align:center;">Qty</th>
                <th width="25%" style="text-align:center;">Price</th>
                <th width="25%" style="text-align:center;">Total</th>
                <th style="text-align:center;">Delete</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            @if (count($cartItems) < 1)
            <tr>
                <td colspan="6" style="text-align:center;">Upss.. Keranjangmu Kosong nich. Masukin Barang ke keranjang Yuk!!!</td>
            </tr>
            @endif
            @foreach($cartItems as $item)
            <tr>
                <td>
                    <input type="checkbox" class="item-check large-checkbox" data-price="{{ $item->item->price }}" data-id-product="{{$item->item->id}}" onchange="updateTotal()">
                </td>
                <td>
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item->item->image) }}" alt="{{ $item->item->name }}">
                        <span>{{ $item->item->name }}</span>
                    </div>
                </td>
                <td>
                    <div class="quantity-control" >
                        <button onclick="decreaseQuantity({{ $item->item->id }})">-</button>
                        <input type="number" id="quantity-{{ $item->item->id }}" value="{{ $item->qty }}" min="1" max="{{ $item->item->stock }}" data-item-id="{{ $item->item->id }}" onchange="updateTotal()">
                        <button onclick="increaseQuantity({{ $item->item->id }}, {{ $item->item->stock }})">+</button>
                    </div>
                </td>
                <td style="text-align:center;">Rp. {{ number_format($item->item->price) }}</td>
                <td style="text-align:center;" id="total-{{ $item->item->id }}">Rp. {{ number_format($item->item->price * $item->qty) }}</td>
                <td style="text-align:center;" class="delete-cart"><a href="{{route('hapus',['product_id'=>$item->id])}}"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cart-actions">
        <p>Total Harga: <span id="total-price">Rp. 0</span></p>
        @if (count($cartItems) < 1)
        <button class="btn checkout-btn">Tidak bisa Checkout</button>
        @else
        <button class="btn checkout-btn" onclick="checkout()">Checkout</button>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>


   // Fungsi untuk menaikkan jumlah qty
   function increaseQuantity(itemId, maxStock) {
        const input = document.getElementById(`quantity-${itemId}`);
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
            updateTotal();
        } else {
            alert("Stock tidak mencukupi");
        }
    }
    // Fungsi untuk menurunkan jumlah qty
    function decreaseQuantity(itemId) {
        const input = document.getElementById(`quantity-${itemId}`);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateTotal();
        }
    }







   let total = 0; // Jadikan total sebagai variabel global

// Fungsi untuk toggle semua checkbox
function toggleAll(source) {
    const checkboxes = document.querySelectorAll('.item-check');
    checkboxes.forEach(checkbox => checkbox.checked = source.checked);
    updateTotal();
}

let checkedProductsAndQty = []
// Fungsi untuk update total harga berdasarkan checkbox
function updateTotal() {
    const checkboxes = document.querySelectorAll('.item-check:checked');
    total = 0; // Reset nilai total
    checkedProductsAndQty = [] //reset product yang di checklist

    checkboxes.forEach(checkbox => {
        const row = checkbox.closest('tr');
        const input = row.querySelector('input[type="number"]');
        const price = parseFloat(checkbox.getAttribute('data-price'));
        checkedProductsAndQty.push({"product_id" : checkbox.getAttribute('data-id-product'),"qty" : input.value})
        const quantity = parseInt(input.value);
        total += price * quantity;

        // Update total per item
        const itemTotal = row.querySelector(`#total-${input.getAttribute('data-item-id')}`);
        itemTotal.textContent = `Rp. ${(price * quantity).toLocaleString()}`;
    });

    document.getElementById('total-price').textContent = `Rp. ${total.toLocaleString()}`;
}

// Fungsi simulasi checkout
function checkout() {

    const selectedItems = Array.from(document.querySelectorAll('.item-check:checked'));
    if (selectedItems.length === 0) {
        alert('Pilih setidaknya satu item untuk checkout.');
        return;
    }

    const csrfToken = '{{ csrf_token() }}'; // Pastikan Laravel CSRF token di-include

    // Kirim request POST ke endpoint /order
    fetch("{{route('order')}}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Untuk proteksi CSRF Laravel
        },
        body: JSON.stringify({ checkout_products:checkedProductsAndQty })
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        alert("barang berhasil di-checkout")
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses order.');
    });
}

</script>


@endpush
