<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Yazid Store')</title>
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

  <main>
    @yield('content')
  </main>

  <!-- Stack untuk script tambahan -->
  @stack('scripts')
</body>
</html>
