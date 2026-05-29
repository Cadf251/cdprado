<nav class="nav nav--guest js--nav">
  <div class="nav--guest__avatar">
    <img src="{{ asset('images/logo.webp') }}" alt="Nav Logo">
    <strong class="toggle-desk">@cdprado.dev</strong>
  </div>
  <div class="nav--guest__bar toggle-mobile js--nav-bar"><i class="fa-solid fa-bars"></i></div>
  <div class="nav--guest__content js--nav-content">
    <div class="nav--guest__content__links">
      <strong class="toggle-mobile js--nav-close">X</strong>
      <strong class="toggle-mobile">@cdprado.dev</strong>
      <a href="{{ route('guest.home') }}">Home</a>
      <a href="{{ route('blog.home') }}">Blog</a>
      <a href="{{ route('auth.login') }}" class="link link--secondary"><i class="fa-solid fa-circle-user"></i> Login</a>
      <a href="{{ route('guest.orcamento') }}" class="link"><i class="fa-solid fa-bolt"></i> Orçamento</a>
    </div>
  </div>
  <div class="nav__bg"></div>
</nav>