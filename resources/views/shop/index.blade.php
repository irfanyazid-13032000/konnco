<!-- resources/views/product/detail.blade.php -->
@extends('layouts.app')

@section('title', 'Your Store')

@section('content')
<div class="shop">
  <div class="container">

  @foreach ($items as $item)
  <a href="{{route('detail.product',['id'=>$item->id])}}">
    <div class="card">
      <img src="{{ asset('storage/' . $item->image) }}" alt="">
      <p class="judul">{{$item->name}}</p>
      <p class="harga">Rp. {{number_format($item->price)}}</p>
    </div>
  </a>
  @endforeach

  


  </div>
</div>
@endsection

