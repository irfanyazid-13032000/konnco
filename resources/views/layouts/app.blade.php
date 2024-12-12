<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
  @yield('title', 'Your Store')    
  </title>
  <link rel="stylesheet" href="{{ asset('css/shop/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/shop/detail.css') }}">
</head>
<body>
  <nav class="navbar">
    
    <div class="logo">
      <a href="/" class="home-link">
      @if (session()->has('full_name'))
          {{ session('full_name') }}'s Store
      @else
          Your Store
      @endif
      </a>
    </div>
    <ul class="menu">
      <li><a href="#">Services</a></li>
      @if (session()->has('full_name'))
      <li><a href="{{route('logout')}}">Logout</a></li>
      @else
      <li><a href="{{route('login.index')}}">Login</a></li>
      @endif
     
    </ul>
    <a href="{{route('keranjang')}}" class="cta">Cart</a>
  </nav>

  <main>
    @yield('content')
  </main>

  <!-- Stack untuk script tambahan -->
  @stack('scripts')
</body>
</html>
