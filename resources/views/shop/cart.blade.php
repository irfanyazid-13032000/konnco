@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="cart-container">
    <h1>Keranjang Belanja</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all" onclick="toggleAll(this)"></th>
                <th width="25%" style="text-align:center;">Produk</th>
                <th width="25%" style="text-align:center;">Qty</th>
                <th width="25%" style="text-align:center;">Harga</th>
                <th width="25%" style="text-align:center;">Total</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            @foreach($cartItems as $item)
            <tr>
                <td>
                    <input type="checkbox" class="item-check" data-price="{{ $item->price }}" onchange="updateTotal()">
                </td>
                <td>
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                        <span>{{ $item->name }}</span>
                    </div>
                </td>
                <td>
                    <div class="quantity-control" >
                        <button onclick="decreaseQuantity({{ $item->id }})">-</button>
                        <input type="number" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" min="1" max="{{ $item->stock }}" data-item-id="{{ $item->id }}" onchange="updateTotal()">
                        <button onclick="increaseQuantity({{ $item->id }}, {{ $item->stock }})">+</button>
                    </div>
                </td>
                <td style="text-align:center;">Rp. {{ number_format($item->price) }}</td>
                <td style="text-align:center;" id="total-{{ $item->id }}">Rp. {{ number_format($item->price * $item->quantity) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cart-actions">
        <p>Total Harga: <span id="total-price">Rp. 0</span></p>
        <button class="btn checkout-btn" onclick="checkout()">Checkout</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi untuk toggle semua checkbox
    function toggleAll(source) {
        const checkboxes = document.querySelectorAll('.item-check');
        checkboxes.forEach(checkbox => checkbox.checked = source.checked);
        updateTotal();
    }

    // Fungsi untuk update total harga berdasarkan checkbox
    function updateTotal() {
        const checkboxes = document.querySelectorAll('.item-check:checked');
        let total = 0;

        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const input = row.querySelector('input[type="number"]');
            const price = parseFloat(checkbox.getAttribute('data-price'));
            const quantity = parseInt(input.value);
            total += price * quantity;

            // Update total per item
            const itemTotal = row.querySelector(`#total-${input.getAttribute('data-item-id')}`);
            itemTotal.textContent = `Rp. ${(price * quantity).toLocaleString()}`;
        });

        document.getElementById('total-price').textContent = `Rp. ${total.toLocaleString()}`;
    }

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

    // Fungsi simulasi checkout
    function checkout() {
        const selectedItems = Array.from(document.querySelectorAll('.item-check:checked'));
        if (selectedItems.length === 0) {
            alert('Pilih setidaknya satu item untuk checkout.');
            return;
        }
        alert('Checkout berhasil! Barang Anda sedang diproses.');
    }
</script>
@endpush
