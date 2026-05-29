<main class="main main--guest">
  <div class="main__content">
    <h1 class="titulo">{{ $title ?? "" }}</h1>
    <p class="descricao">{{ $description ?? "" }}</p>
    @include('components.ui.button', $button ?? [
      "href" => route('guest.orcamento'),
      "icon" => "fa-solid fa-bolt",
      "cta" => "Solicitar Orçamento Personalizado"
    ])
  </div>
  <div class="main__mockup">
    <img src="{{ asset('images/desktop-model.webp') }}" class="main__desktop" alt="">
    <img src="{{ asset('images/phone-model.webp') }}" class="main__phone" alt="">
  </div>
</main>