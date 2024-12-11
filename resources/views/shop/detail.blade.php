<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk</title>
  <link rel="stylesheet" href="{{ asset('css/shop/detail.css') }}">
</head>
<body>
  <nav class="navbar">
    <div class="logo">Yazid Store</div>
    <ul class="menu">
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <a href="#" class="cta">Cart (13)</a>
  </nav>

  <div class="product-detail">
    <div class="product-image">
      <img src="https://images.tokopedia.net/img/cache/900/VqbcmM/2024/11/4/2d46ac2e-8ddf-4cd2-8a8e-c6396ca60a81.png" alt="Sabun Nuvo Nih">
    </div>
    <div class="product-info">
      <h1>Sabun Nuvo Nih</h1>
      <p class="price">Rp. 23.000</p>
      <p class="stock">Sisa produk: 50</p>
      <p class="description">Sabun mandi anti-bakteri untuk melindungi keluarga Anda dari kuman. Tersedia dengan wangi segar yang tahan lama.</p>

      <div class="product-actions">
        <div class="quantity-control">
          <button onclick="decreaseQuantity()">-</button>
          <input type="number" id="quantity" value="1" min="1" max="3">
          <button onclick="increaseQuantity()">+</button>
        </div>
        <button class="add-to-cart">+ Keranjang</button>
        <button class="buy-now">Beli Langsung</button>
      </div>
    </div>
  </div>

  <script>
    function increaseQuantity() {
      const input = document.getElementById('quantity');
      if (parseInt(input.value) < parseInt(input.max)) {
        input.value = parseInt(input.value) + 1;
      }else{
        alert("stock kami tidak sebanyak ini")
      }
    }

    function decreaseQuantity() {
      const input = document.getElementById('quantity');
      if (parseInt(input.value) > parseInt(input.min)) {
        input.value = parseInt(input.value) - 1;
      }
    }
  </script>
</body>
</html>