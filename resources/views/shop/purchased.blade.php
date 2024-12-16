@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
<div class="cart-container">
    <h1>{{ session('full_name') }}'s Purchased</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th style="text-align:center;">Product</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:center;">Price</th>
                <th style="text-align:center;">Total Price</th>
                <th style="text-align:center;">Date</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            @if (count($purchased_item) < 1)
            <tr>
                <td colspan="6" style="text-align:center;">Upss.. Kamu belum pernah belanja nich!!!</td>
            </tr>
            @endif
            @foreach($purchased_item as $item)
            <tr>
                <td>
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                        <span>{{ $item->name }}</span>
                    </div>
                </td>
                <td style="text-align:center;">{{$item->qty}}</td>
                <td style="text-align:center;">{{$item->price}}</td>
                <td style="text-align:center;">{{$item->price * $item->qty}}</td>
                <td style="text-align:center;">{{$item->formatted_date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
</div>
@endsection

