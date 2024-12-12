<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Your Store')</title>
  <link rel="stylesheet" href="{{ asset('css/shop/index.css') }}">
</head>
<body>
  <main class="auth-page">
    @yield('content')
  </main>
</body>
</html>
