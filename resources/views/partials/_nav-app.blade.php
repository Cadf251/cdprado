<nav class="nav nav--extendido">
  <button type="button" class="nav__button js--nav-button">
    <i class="fa-solid fa-bars"></i>
  </button>
  <div class="nav__userdata">
    <div class="foto">
      <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="">
    </div>
    <div class="c-4">
      @auth
        <strong>{{ auth()->user()->name }}</strong>
        <p>Empresa: {{ auth()->user()->currentTenant()->name }}</p>
        <p>Papel: {{ auth()->user()->current_membership->role->label() }}</p>
      @endauth
    </div>
  </div>
  <div class="nav__icons">
    <a href="/perfil" class="nav__link"><i class="fa-solid fa-circle-user"></i> Perfil</a>
    <a class='nav__link' href="/projetos">
      <i class="fa-solid fa-code"></i> Projetos</a>
    <a href="/logout" class="nav__link"><i class="fa-solid fa-power-off"></i> Sair</a>
  </div>
</nav>