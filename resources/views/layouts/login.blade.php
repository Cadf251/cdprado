<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>@yield('title') | My Application</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
  @include("partials._nav-guest")
  
  <main class="main main--auth">
    <div class="card--glass w5">
      @yield("content")
    </div>
  </main>

  @include("partials._footer-guest")
</body>
</html>