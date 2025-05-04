<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="shortcut icon"
    href="/images/logo.svg"
    type="image/x-icon"
  />
</head>
<body>
    <header>
        @include('components.header')
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <!-- Include Footer -->
        @include('components.footer')
    </footer>
</body>
</html>
