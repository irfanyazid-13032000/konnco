<!-- resources/views/product/detail.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
  <div class="product-detail">
    <div class="product-image">
      <img src="{{ asset('storage/' . $item->image) }}">
    </div>
    <div class="product-info">
      <h1>{{$item->name}}</h1>
      <p class="price">Rp. {{number_format($item->price)}}</p>
      <p class="stock">Sisa produk: {{$item->stock}}</p>
      <p class="description">{{$item->description}}</p>

      <div class="product-actions">
        <div class="quantity-control">
          <button onclick="decreaseQuantity()">-</button>
          <input type="number" id="quantity" value="1" min="1" max="{{$item->stock}}">
          <button onclick="increaseQuantity()">+</button>
        </div>
        <button class="add-to-cart">+ Keranjang</button>
        <button class="buy-now">Beli Langsung</button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function increaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) < parseInt(input.max)) {
      input.value = parseInt(input.value) + 1;
    } else {
      alert("Stock kami tidak sebanyak ini");
    }
  }

  function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > parseInt(input.min)) {
      input.value = parseInt(input.value) - 1;
    }
  }
</script>
@endpush
